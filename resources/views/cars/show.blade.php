@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $car->brand }} {{ $car->model }}</h1>
    <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>
    <p><strong>Prijs:</strong> {{ $car->price }} €</p>
    <p><strong>Kilometerstand:</strong> {{ $car->mileage }} km</p>
    <p><strong>Aantal Zitplaatsen:</strong> {{ $car->seats ?? 'N/A' }}</p>
    <p><strong>Aantal Deuren:</strong> {{ $car->doors ?? 'N/A' }}</p>
    <p><strong>Productiejaar:</strong> {{ $car->production_year ?? 'N/A' }}</p>
    <p><strong>Gewicht:</strong> {{ $car->weight ?? 'N/A' }} kg</p>
    <p><strong>Kleur:</strong> {{ $car->color ?? 'N/A' }}</p>
    <p><strong>Afbeelding:</strong> <img src="{{ $car->image }}" alt="Auto afbeelding" style="max-width: 100%; height: auto;"></p>
    <p><strong>Verkocht op:</strong> {{ $car->sold_at ? \Carbon\Carbon::parse($car->sold_at)->format('d-m-Y') : 'N/A' }}</p>
    <p><strong>Aantal Weergaven:</strong> {{ $car->views }}</p>
    <a href="{{ route('cars.index') }}" class="btn btn-primary">Terug naar Mijn Auto's</a>
</div>
@endsection
