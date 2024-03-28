<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Conference;
use App\Models\Manifestation;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MuseumController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth')->except('index', 'artists', 'artworks', 'visits', 'calendar');
    }
    public function profile()
    {
        return view('profile');
    }
    public function profileUpdate(Request $request)
    {
        // validate repeat password and email
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
        ]);
        // dd($request->old_password);
        if ($request->old_password) {
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                Alert::toast("Le mot de passe est incorrect", 'error');
                return redirect()->back();
            }
        }

        // update user inforations
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        // check old pass
        $user->password = bcrypt($request->password);
        $user->category = $request->category;
        $user->save();
        // if change password
        if ($request->password) {
            Auth::logout();
            Alert::toast("Votre mot de passe a été changé avec succès", 'success');
            return redirect()->route('login');
        }
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->back();
    }
    // return artists
    public function artists()
    {
        $artist = User::where('role', 'artist')->with('artist')->paginate(9);
        return view('artists', [
            'artists' => $artist
        ]);
    }
    // return artworks
    public function artworks()
    {
        $artworks = Artwork::with('artist')->paginate(9);
        return view('oeuvres', [
            'artworks' => $artworks
        ]);
    }
    // return visite
    public function visits()
    {
        $tarifs = Tarif::all();

        return view('visits', [
            'tarifs' => $tarifs
        ]);
    }

    public function calendar()
    {
        $conferences = Conference::with('conferencier:id,name')->get();
        $events = [];
        foreach ($conferences as $conference) {
            array_push($events, [
                'id' => $conference->id,
                'title' => 'Sujet : ' . $conference->sujet . ' - conférencier : ' . $conference->conferencier->name . ' - salle de conférence',
                'start' => $conference->date,
                'color' =>  '#0dcaf0'
            ]);
        }
        $manifestations = Manifestation::get();
        foreach ($manifestations as $manifestation) {
            array_push($events, [
                'id' => $manifestation->id,
                'title' => $manifestation->theme,
                'start' => $manifestation->start_date,
                'end' => $manifestation->end_date,
                'color' =>  '#fd7e14'
            ]);
        }
        return view('calendar', [
            'events' => json_encode($events),
        ]);
    }
}
