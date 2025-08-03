<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $people = Person::query()
            ->when($search, function ($query, $search) {
                return $query->where('reference', 'like', "%{$search}%")
                            ->orWhere('nom', 'like', "%{$search}%")
                            ->orWhere('marque', 'like', "%{$search}%");
            })
            ->get();

        return view('people.index', compact('people'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function show($id)
    {
        $user = Person::find($id);

        return view('people.show', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:people,reference|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'largeur' => 'nullable|numeric',
            'profondeur' => 'nullable|numeric',
            'hauteur' => 'nullable|numeric',
            'puissance' => 'nullable|numeric',
            'feux' => 'nullable|numeric',
            'tension' => 'nullable|numeric',
            'plaque' => 'nullable|numeric',
            'volume' => 'nullable|numeric',
            'broche' => 'nullable|numeric',
            'porte' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'bac' => 'nullable|numeric',
            'niveau' => 'nullable|numeric',
            'num_pizza' => 'nullable|numeric',
            'dim_plaque' => 'nullable|string|max:255',
            'num_cylindre' => 'nullable|numeric',
            'dim_rouleaux' => 'nullable|numeric',
            'model' => 'nullable|string|max:255',
            'capacite_l' => 'nullable|numeric',
            'capacité_kg' => 'nullable|numeric',
            'production' => 'nullable|numeric',
            'lame' => 'nullable|numeric',
            'soud' => 'nullable|numeric',
            'prix' => 'nullable|numeric',
            'serie' => 'nullable|numeric',
        ]);
       
        $person = new Person($request->all());
        $person->prix = $request->input('prix');

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $person->photo = $imageName;
        }

        $person->save();

        return redirect()->route('admin.view')->with('success', 'Produit créé avec succès');
    }

    public function edit($id)
    {
        $person = Person::find($id);

        return view('people.edit', compact('person'));
    }

    public function update(Request $request, $id)
    {
        $person = Person::find($id);

        $request->validate([
            'reference' => 'required|unique:people,reference,' . $person->id . '|max:255',
            'nom' => 'required|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'largeur' => 'nullable|numeric',
            'profondeur' => 'nullable|numeric',
            'hauteur' => 'nullable|numeric',
            'puissance' => 'nullable|numeric',
            'feux' => 'nullable|numeric',
            'tension' => 'nullable|numeric',
            'plaque' => 'nullable|numeric',
            'volume' => 'nullable|numeric',
            'broche' => 'nullable|numeric',
            'porte' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'bac' => 'nullable|numeric',
            'niveau' => 'nullable|numeric',
            'num_pizza' => 'nullable|numeric',
            'dim_plaque' => 'nullable|string|max:255',
            'num_cylindre' => 'nullable|numeric',
            'dim_rouleaux' => 'nullable|numeric',
            'model' => 'nullable|string|max:255',
            'capacite_l' => 'nullable|numeric',
            'capacité_kg' => 'nullable|numeric',
            'production' => 'nullable|numeric',
            'lame' => 'nullable|numeric',
            'soud' => 'nullable|numeric',
            'prix' => 'nullable|numeric',
            'serie' => 'nullable|numeric',

        ]);

        $person->update($request->all());
        $person->prix = $request->input('prix');

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $person->photo = $imageName;
            $person->save();
        }

        return redirect()->route('admin.view')->with('success', 'Produit modifié avec succès');
    }

    public function delete(Request $request, $id)
    {
        $user = Person::find($id);

        if ($user) {
            $user->delete();
            return redirect('admin')->with('success', 'Produit supprimé avec succès.');
        }

        return redirect('admin')->with('error', 'Produit non trouvé');
    }
}
