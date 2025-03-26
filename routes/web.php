<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|        @livewire('car-status', ['car' => $car])

*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    //
});

require __DIR__.'/auth.php';
use App\Http\Controllers\CarController;

//Route::middleware(['auth'])->group(function () {
    // Route voor het tonen van het formulier om een auto toe te voegen
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');

    // Route voor het opslaan van een nieuwe auto
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');

    // Route voor het overzicht van auto's van de ingelogde gebruiker
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

    // Route voor het tonen van de details van een specifieke auto
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    // Route voor het verwijderen van een auto
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Route voor het tonen van het bewerkingsformulier van een auto
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');

    // Route voor het bijwerken van een auto
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');

//});
Route::get('/cars/public', [CarController::class, 'public'])->name('cars.public');
Route::get('/public-cars', [CarController::class, 'public'])->name('cars.public');
// Route om auto-informatie op te halen via het kenteken
Route::get('/auto-info', [CarController::class, 'getCarInfoFromRDW']);
