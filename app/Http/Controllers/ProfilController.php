<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function show()
    {
        return view('profil', ['petugas' => Auth::user()]);
    }
}