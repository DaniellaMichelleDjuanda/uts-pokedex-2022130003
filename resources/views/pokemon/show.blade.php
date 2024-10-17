@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">{{ $pokemon->name }} Details</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $pokemon->photo ? asset('storage/' . $pokemon->photo) : 'https://placehold.co/200' }}" class="card-img-top" alt="{{ $pokemon->name }}">
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Pokemon Details</h5>
                    <p class="card-text">ID: #{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}</p>
                    <p class="card-text">Species: {{ $pokemon->species }}</p>
                    <p class="card-text">Weight: {{ $pokemon->weight }} kg</p>
                    <p class="card-text">Height: {{ $pokemon->height }} m</p>
                    <p class="card-text">HP: {{ $pokemon->hp }}</p>
                    <p class="card-text">Attack: {{ $pokemon->attack }}</p>
                    <p class="card-text">Defense: {{ $pokemon->defense }}</p>
                    <p class="card-text">Is Legendary: {{ $pokemon->is_legendary ? 'Yes' : 'No' }}</p>

                    <h6 class="mt-3">Types</h6>
                    <div>
                        @foreach(explode(',', $pokemon->primary_type) as $type)
                            <span class="badge bg-success me-1">{{ $type }}</span> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('pokedex') }}" class="btn btn-primary mt-4">Back to Pokedex</a>
    </div>
</div>
@endsection
