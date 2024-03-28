<?php

namespace App\Http\Controllers;

use App\Mail\ArtistAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ArtistsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    //index
    public function index()
    {
        $artists = User::where('role', 'artist')->withTrashed()->orderBy('created_at', 'desc')->paginate('10');
        return view('admin.artists.index', [
            'artists' => $artists
        ]);
    }
    // store artist 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'required',
            'bio' => 'required',
            'genre' => 'required',
            'location' => 'required'

        ]);
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('images', $request->file('avatar'));
        }
        $artist = new User();
        $artist->name = $request->name;
        $artist->email = $request->email;
        //generate string
        $password_artist = Str::random(10);
        $artist->password = Hash::make($password_artist);
        $artist->avatar = $path;
        $artist->role = 'artist';
        $artist->save();
        //sen dmail to artist
        $details = [
            'title' => 'Welcome to the platform',
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $password_artist
        ];
        // Mail::to($request->email)->send(new ArtistAccount($details));
            
        // relation with artist table 

        $artist->artist()->create([
            'phone' => $request->phone,
            'bio' => $request->bio,
            'genre' => $request->genre,
            'location' => $request->location,
        ]);
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('artists.index');
    }
    // update artist
    public function update(Request $request, $id)
    {
        // update user table        
        $artist = User::find($id);
        $artist->name = $request->name;
        $artist->email = $request->email;
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('images', $request->file('avatar'));
            $artist->avatar = $path;
        }
        $artist->save();
        // relation with artist table 
        $artist->artist()->update([
            'phone' => $request->phone,
            'bio' => $request->bio,
            'genre' => $request->genre,
            'location' => $request->location,
        ]);
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('artists.index');
    }
    // delete artist soft
    public function destroy($id)
    {
        $artist = User::find($id);
        $artist->delete();
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('artists.index');
    }
    // restore artist soft
    public function restore($id)
    {
        $artist = User::withTrashed()->find($id);
        $artist->restore();
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('artists.index');
    }
    

}
