@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Pokedex</h1>

    <div class="row">
        @foreach ($pokemons as $pokemon)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('pokemons.show', $pokemon->id) }}">
                        <img src="{{ $pokemon->photo ? asset('storage/' . $pokemon->photo) : 'https://placehold.co/200' }}" class="card-img-top" alt="{{ $pokemon->name }}">
                    </a>
                    <div class="card-body">
                        <p class="card-text">#{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}</p>
                        <h5 class="card-title">
                            <a href="{{ route('pokemons.show', $pokemon->id) }}">{{ $pokemon->name }}</a>
                        </h5>
                        <div>
                            @foreach(explode(',', $pokemon->primary_type) as $type) 
                                <span class="badge bg-success">{{ $type }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $pokemons->links() }} 
    </div>
</div>
@endsection
