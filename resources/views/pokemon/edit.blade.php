@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($pokemon) ? 'Edit' : 'Create' }} Pokemon</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($pokemon) ? route('pokemons.update', $pokemon->id) : route('pokemons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($pokemon))
            @method('PUT') 
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $pokemon->name ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="species" class="form-label">Species</label>
            <input type="text" class="form-control" id="species" name="species" value="{{ old('species', $pokemon->species ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="primary_type" class="form-label">Primary Type</label>
            <select class="form-select" id="primary_type" name="primary_type">
                @foreach(['Grass', 'Fire', 'Water', 'Bug', 'Normal', 'Poison', 'Electric', 'Ground', 'Fairy', 'Fighting', 'Psychic', 'Rock', 'Ghost', 'Ice', 'Dragon', 'Dark', 'Steel', 'Flying'] as $type)
                    <option value="{{ $type }}" {{ old('primary_type', $pokemon->primary_type ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight', $pokemon->weight ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Height</label>
            <input type="number" class="form-control" id="height" name="height" value="{{ old('height', $pokemon->height ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="hp" class="form-label">HP</label>
            <input type="number" class="form-control" id="hp" name="hp" value="{{ old('hp', $pokemon->hp ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="attack" class="form-label">Attack</label>
            <input type="number" class="form-control" id="attack" name="attack" value="{{ old('attack', $pokemon->attack ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="defense" class="form-label">Defense</label>
            <input type="number" class="form-control" id="defense" name="defense" value="{{ old('defense', $pokemon->defense ?? '') }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_legendary" name="is_legendary" value="1" {{ old('is_legendary', $pokemon->is_legendary ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_legendary">Is Legendary?</label>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            @if(isset($pokemon) && $pokemon->photo)
                <div>
                    <img src="{{ asset('storage/' . $pokemon->photo) }}" alt="Pokemon Photo" style="max-width: 150px; max-height: 150px; display: block; margin-bottom: 10px;">
                </div>
            @endif
            <input type="file" class="form-control" id="photo" name="photo">
        </div>


        <button type="submit" class="btn btn-success">{{ isset($pokemon) ? 'Update' : 'Create' }} Pokemon</button>
        <a href="{{ route('pokemons.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
