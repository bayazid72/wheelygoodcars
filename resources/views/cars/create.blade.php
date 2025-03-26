@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nieuwe Auto Toevoegen</h1>
    <form action="{{ route('cars.store') }}" method="POST">
        @csrf
        <div class="kenteken">
            <div class="inset">
              <div class="blue">
                <h1>NL</h1>
              </div>
              <input type="text" class="form-control" id="license_plate" name="license_plate"  maxlength="6" pattern="[A-Z0-9]{0,9}"  placeholder="XP-004-T"/>
            </div>
          </div>
        <div class="form-group">
            <label for="brand">Merk</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <div class="form-group">
            <label for="price">Prijs</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="mileage">Kilometerstand</label>
            <input type="number" class="form-control" id="mileage" name="mileage" required>
        </div>
        <div class="form-group">
            <label for="seats">Aantal Zitplaatsen</label>
            <input type="number" class="form-control" id="seats" name="seats">
        </div>
        <div class="form-group">
            <label for="doors">Aantal Deuren</label>
            <input type="number" class="form-control" id="doors" name="doors">
        </div>
        <div class="form-group">
            <label for="production_year">Productiejaar</label>
            <input type="number" class="form-control" id="production_year" name="production_year">
        </div>
        <div class="form-group">
            <label for="weight">Gewicht</label>
            <input type="number" class="form-control" id="weight" name="weight">
        </div>
        <div class="form-group">
            <label for="color">Kleur</label>
            <input type="text" class="form-control" id="color" name="color">
        </div>
        <div class="form-group">
            <label for="image">Afbeelding (Optioneel)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>


        <div class="form-group">
            <label for="sold_at">Verkocht op</label>
            <input type="date" class="form-control" id="sold_at" name="sold_at">
        </div>
        <div class="form-group">
            <label for="views">Aantal Weergaven</label>
            <input type="number" class="form-control" id="views" name="views" value="0">
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
@endsection
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
