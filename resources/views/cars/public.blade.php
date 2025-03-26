@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alle Auto's</h1>

    <div class="parent">
        @foreach($cars as $index => $car)
            <div class="car div{{ $index + 1 }}">
                <h3>{{ $car->brand }} {{ $car->model }}</h3>
                <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>
                <p><strong>Prijs:</strong> €{{ number_format($car->price, 2) }}</p>

                @if($car->image)
                    <div>
                        <img src="{{ asset('storage/' . $car->image) }}" alt="Auto afbeelding" class="car-image">
                    </div>
                @else
                    <p>Geen afbeelding beschikbaar</p>
                @endif

                <p><strong>Aantal Weergaven:</strong> {{ $car->views }}</p>
                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">Bekijk details</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
