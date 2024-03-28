<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Salle;
use App\Models\User;
use App\Rules\SalleCapacityCheckRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ArtworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    // index
    public function index()
    {
        $artworks = Artwork::orderBy('created_at', 'desc')->with('artist:id,name', 'salle:id,name')->withTrashed()->paginate('10');
        $artists = User::where('role', 'artist')->get(['id', 'name']);
        $salles = Salle::all();
        return view('admin.artworks.index', [
            'artworks' => $artworks,
            'artists' => $artists,
            'salles' => $salles
        ]);
    }
    // store 
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist_id' => 'required',
            'salle_id' => ['required', new SalleCapacityCheckRule()],
            'number' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'price' => 'required',
            'origine' => 'required',
            'assurance_type' => 'required',
            'security_conditions' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('images', $request->file('image'));
        }
        $artwork = new Artwork();
        $artwork->title = $request->title;
        $artwork->number = $request->number;
        $artwork->description = $request->description;
        $artwork->image = $path;
        $artwork->price = $request->price;
        $artwork->origine = $request->origine;
        $artwork->assurance_type = $request->assurance_type;
        $artwork->security_conditions = $request->security_conditions;
        $artwork->artist_id = $request->artist_id;
        $artwork->salle_id = $request->salle_id;
        $artwork->save();
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        
        return redirect()->back();
    }
    // update 
    public function update(Request $request, $id)
    {
        $request->validate([
            'artist_id' => 'required',
            'salle_id' => ['required', new SalleCapacityCheckRule()],
            'title' => 'required',
            'number' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'price' => 'required',
            'origine' => 'required',
            'assurance_type' => 'required',
            'security_conditions' => 'required'
        ]);
        $artwork = Artwork::find($id);
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('images', $request->file('image'));
            $artwork->image = $path;
        }
        $artwork->title = $request->title;
        $artwork->number = $request->number;
        $artwork->description = $request->description;
        $artwork->price = $request->price;
        $artwork->origine = $request->origine;
        $artwork->assurance_type = $request->assurance_type;
        $artwork->security_conditions = $request->security_conditions;
        $artwork->artist_id = $request->artist_id;
        $artwork->salle_id = $request->salle_id;
        $artwork->save();
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->back();
    }
    // delete
    public function destroy($id)
    {
        $artwork = Artwork::find($id);
        $artwork->delete();
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->back();
    }
    // restore
    public function restore($id)
    {
        $artwork = Artwork::withTrashed()->find($id);
        $artwork->restore();
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->back();
    }

    
}
