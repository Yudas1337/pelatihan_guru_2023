<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index($name)
    {
        return view('profile', compact('name'));
    }
}
