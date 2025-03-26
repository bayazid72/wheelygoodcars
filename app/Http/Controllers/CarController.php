<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use GuzzleHttp\Client;

class CarController extends Controller
{
    // Formulier tonen (auto toevoegen)
    public function create()
    {
        return view('cars.create');
    }

    // Auto opslaan in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:10|unique:cars',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'production_year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255',
            'views' => 'nullable|integer',
        ]);

        Car::create([
            'user_id' => Auth::id(),
            'license_plate' => $validated['license_plate'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'price' => $validated['price'],
            'mileage' => $validated['mileage'],
            'seats' => $validated['seats'],
            'doors' => $validated['doors'],
            'production_year' => $validated['production_year'],
            'weight' => $validated['weight'],
            'color' => $validated['color'],
            'image' => $validated['image'],
            'views' => $validated['views'] ?? 0,
        ]);

        return redirect()->route('cars.index')->with('success', 'Auto succesvol aangemaakt!');
    }

    // Overzicht van auto's voor de ingelogde gebruiker
    public function index()
    {
        if (Auth::check()) {

            $cars = Auth::user()->cars;
        } else {

            $cars = [];
        }

        return view('cars.index', compact('cars'));
    }



        public function show(Car $car)
    {
        // Controleer of de ingelogde gebruiker de eigenaar van de auto is
        

        return view('cars.show', compact('car'));
    }


    public function destroy(Car $car)
    {
        // Controleer of de ingelogde gebruiker de eigenaar van de auto is
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Je mag deze auto niet verwijderen.');
        }


        $car->delete();


        return redirect()->route('cars.index')->with('success', 'Auto succesvol verwijderd!');
    }

    public function edit(Car $car)
    {
        // Controleer of de ingelogde gebruiker de eigenaar is
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Je mag deze auto niet bewerken.');
        }

        return view('cars.edit', compact('car'));
    }

    // Bijwerken van een auto
    public function update(Request $request, Car $car)
    {
        // Controleer of de ingelogde gebruiker de eigenaar is
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Je mag deze auto niet bewerken.');
        }

        // Valideer de ingevoerde gegevens
        $validated = $request->validate([
            'license_plate' => 'required|string|max:10|unique:cars,license_plate,' . $car->id,
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'production_year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255',
            'views' => 'nullable|integer',
        ]);

        // Werk de auto bij met de nieuwe gegevens
        $car->update([
            'license_plate' => $validated['license_plate'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'price' => $validated['price'],
            'mileage' => $validated['mileage'],
            'seats' => $validated['seats'],
            'doors' => $validated['doors'],
            'production_year' => $validated['production_year'],
            'weight' => $validated['weight'],
            'color' => $validated['color'],
            'image' => $validated['image'],
            'views' => $validated['views'] ?? 0,
        ]);

        // Redirect naar de lijst van auto's
        return redirect()->route('cars.index')->with('success', 'Auto succesvol bijgewerkt!');
    }


        public function public()
    {
        // Haal alle auto's op van alle gebruikers
        $cars = Car::all();


        return view('cars.public', compact('cars'));
    }

    public function getCarInfoFromRDW(Request $request)
    {
        // Verkrijg kenteken uit de querystring
        $kenteken = $request->input('kenteken');

        if (!$kenteken) {
            return response()->json(['error' => 'Kenteken is vereist'], 400);
        }

        // Maak verbinding met de RDW API via Guzzle
        $client = new Client();
        $apiUrl = "https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$kenteken}";

        // Vervang 'jouw-app-token' met je werkelijke App Token
        $appToken = 'jouw-app-token';

        try {
            // Voer de API-aanroep uit met het App Token in de header
            $response = $client->get($apiUrl, [
                'query' => [
                    '$$app_token' => $appToken
                ]
            ]);

            // Ontvang en decodeer de JSON-response
            $data = json_decode($response->getBody()->getContents(), true);

            // Controleer of we gegevens hebben ontvangen
            if (empty($data)) {
                return response()->json(['error' => 'Geen gegevens gevonden voor dit kenteken.'], 404);
            }

            // Retourneer de gegevens als JSON
            return response()->json($data);

        } catch (\Exception $e) {
            // Foutafhandelingsbericht
            return response()->json(['error' => 'Fout bij het ophalen van gegevens: ' . $e->getMessage()], 500);
        }
    }


}
