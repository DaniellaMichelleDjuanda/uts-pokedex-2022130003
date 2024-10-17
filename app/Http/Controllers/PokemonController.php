<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = Pokemon::paginate(20);  // Fetch paginated Pokémon data
        return view('pokemon.index', compact('pokemons'));  // Pass $pokemons to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pokemon.create');  // Show the form for creating Pokémon
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'hp' => 'required|integer|between:0,9999',
            'attack' => 'required|integer|between:0,9999',
            'defense' => 'required|integer|between:0,9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('photo')) {
            // Store the uploaded file directly in 'storage/app/public'
            $filePath = $request->file('photo')->store('', 'public'); // Use '' to store in the root of public
            $validatedData['photo'] = $filePath; // Save the file path
        }

        // Create the Pokémon record
        Pokemon::create($validatedData);

        // Redirect to the index page with success message
        return redirect()->route('pokemons.index')->with('success', 'Pokemon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        return view('pokemon.show', compact('pokemon'));  // Show the details of the Pokémon
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        return view('pokemon.edit', compact('pokemon'));  // Show the form for editing Pokémon
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'hp' => 'required|integer|between:0,9999',
            'attack' => 'required|integer|between:0,9999',
            'defense' => 'required|integer|between:0,9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        // Handle the file upload (if a new photo is provided)
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($pokemon->photo) {
                \Storage::disk('public')->delete($pokemon->photo);
            }
            
            // Store the new photo directly in 'storage/app/public'
            $filePath = $request->file('photo')->store('', 'public'); // Use '' to store in the root of public
            $validatedData['photo'] = $filePath; // Save the new file path
        } else {
            // Preserve the old photo if no new photo is uploaded
            $validatedData['photo'] = $pokemon->photo;
        }

        // Update the Pokémon record
        $pokemon->update($validatedData);

        // Redirect to the index page with success message
        return redirect()->route('pokemons.index')->with('success', 'Pokemon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        // Delete the photo if it exists
        if ($pokemon->photo) {
            \Storage::disk('public')->delete($pokemon->photo);
        }

        // Delete the Pokémon record
        $pokemon->delete();

        // Redirect to the index page with success message
        return redirect()->route('pokemons.index')->with('success', 'Pokemon deleted successfully.');
    }
}