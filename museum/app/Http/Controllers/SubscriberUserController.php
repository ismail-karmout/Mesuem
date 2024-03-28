<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('subscriber');
    }

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->with('visit') ->orderBy('created_at', 'desc')->paginate('10');
        return view('subscriber', [
            'reservations' => $reservations
        ]);
    }
}
