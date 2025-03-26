@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mijn Auto's</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="parent">
        @forelse($cars as $index => $car)
            <div class="car">
                <h3>{{ $car->brand }} {{ $car->model }}</h3>
                <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>

                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">Bekijk details</a>
                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Bewerken</a>

                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Verwijderen</button>
                </form>
            </div>
        @empty
            <p>Je hebt nog geen auto's toegevoegd.</p>
        @endforelse
    </div>
</div>
@endsection
