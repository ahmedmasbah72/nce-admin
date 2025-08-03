<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser(Request $request)
    {
        $search = $request->input('search');

        $people = Person::query()
            ->when($search, function ($query, $search) {
                return $query->where('reference', 'like', "%{$search}%")
                            ->orWhere('nom', 'like', "%{$search}%")
                            ->orWhere('marque', 'like', "%{$search}%");
            })
            ->get();

        return view('user.user', compact('people'));
    }
}
