<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{
    public function details()
    {
        return view('pet-details');
    }
}
