<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('artist');
    }

    public function index()
    {
        return view('artist');
    }
}
