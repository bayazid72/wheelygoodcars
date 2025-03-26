@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Auto Bewerken</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('cars.update', $car) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="license_plate">Kenteken</label>
            <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ $car->license_plate }}" required>
        </div>
        <div class="form-group">
            <label for="brand">Merk</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ $car->brand }}" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}" required>
        </div>
        <div class="form-group">
            <label for="price">Prijs</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $car->price }}" required>
        </div>
        <div class="form-group">
            <label for="mileage">Kilometerstand</label>
            <input type="number" class="form-control" id="mileage" name="mileage" value="{{ $car->mileage }}" required>
        </div>
        <div class="form-group">
            <label for="seats">Aantal Zitplaatsen</label>
            <input type="number" class="form-control" id="seats" name="seats" value="{{ $car->seats }}">
        </div>
        <div class="form-group">
            <label for="doors">Aantal Deuren</label>
            <input type="number" class="form-control" id="doors" name="doors" value="{{ $car->doors }}">
        </div>
        <div class="form-group">
            <label for="production_year">Productiejaar</label>
            <input type="number" class="form-control" id="production_year" name="production_year" value="{{ $car->production_year }}">
        </div>
        <div class="form-group">
            <label for="weight">Gewicht</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ $car->weight }}">
        </div>
        <div class="form-group">
            <label for="color">Kleur</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ $car->color }}">
        </div>
        <div class="form-group">
            <label for="image">Afbeelding URL</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ $car->image }}">
        </div>
        <div class="form-group">
            <label for="sold_at">Verkocht op</label>
            <input type="date" class="form-control" id="sold_at" name="sold_at" value="{{ $car->sold_at }}">
        </div>
        <div class="form-group">
            <label for="views">Aantal Weergaven</label>
            <input type="number" class="form-control" id="views" name="views" value="{{ $car->views }}">
        </div>
        <button type="submit" class="btn btn-primary">Bijwerken</button>
    </form>
</div>
@endsection
