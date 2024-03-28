<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConferencierUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conferencier');
    }

    public function index()
    {
        return view('conferencier');
    }
}
