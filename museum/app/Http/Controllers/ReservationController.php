<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Tarif;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('subscriber')->except('index');
        $this->middleware('admin')->only('index');

    }
    //index
    public function index()
    {
        $reservations = Reservation::with('user', 'visit')->get();
        $events = [];
        foreach ($reservations as $reservation) {
            array_push($events, [
                'id' => $reservation->id,
                'title' => 'N° visite : ' . $reservation->id . ' - Guide : ' . $reservation->visit->guide_name,
                'start' => $reservation->visit->date,
                'color' =>  '#0dcaf0'
            ]);
        }
        return view(
            'admin.reservations.index',
            [
                'events' => json_encode($events)
            ]
        );
    }
    //store 
    public function store(Request $request)
    {
        $visite = Visit::where('date', $request->date)->first();
        $category = Auth::user()->category;
        $tarif = Tarif::where('category', $category)->first();
        $price = $tarif->tarif * (1 - $tarif->tarif_reduit / 100);
        $price = $price * 3/4;
        $guides =  ['Amine ElAlaoui', 'Ismail Ali', 'Mohamed ali', 'fatima Montassir', 'Halima ElAlaoui'];
        if ($visite) {
            if ($visite->nbr_place >= 15) {
                Alert::toast("Le nombre de place est dépassé", 'error');
                return redirect()->back();
            }
            $visite->nbr_place = $request->nbr_place + 1;
            $visite->save();
            $reservation = new Reservation();
            $reservation->user_id = Auth::user()->id;
            $reservation->visit_id = $visite->id;
            $reservation->tarif = $price;

            $reservation->save();

        } else {
            $visite = new Visit();
            $visite->date = $request->date;
            $visite->guide_name = $guides[rand(0, 4)];
            $visite->nbr_place = $request->nbr_place + 1;
            $visite->save();
            $reservation = new Reservation();
            $reservation->user_id = Auth::user()->id;
            $reservation->visit_id = $visite->id;
            $reservation->tarif = $price;
            $reservation->save();
        }
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('subscriber');
    }
    // delete 
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return redirect()->route('reservations.index');
    }
}
