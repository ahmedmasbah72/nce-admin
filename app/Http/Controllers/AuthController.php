<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $password = $request->input('password');

        if ($password === 'nce@admin') {
            return redirect()->route('admin.view');
        } elseif ($password === 'nce@user') {
            return redirect()->route('user.view');
        } else {
            return redirect()->back()->with('error', 'Mot de passe incorrect');
        }
    }
    
}

