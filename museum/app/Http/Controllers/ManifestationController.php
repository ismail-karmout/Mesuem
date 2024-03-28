<?php

namespace App\Http\Controllers;

use App\Models\Manifestation;
use App\Models\Salle;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Termwind\Components\Dd;

class ManifestationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    // index
    public function index()
    {
        $manifestations = Manifestation::orderBy('created_at', 'desc')->paginate('10');
        $salles = Salle::all();
        return view('admin.manifestations.index', [
            'manifestations' => $manifestations,
            'salles' => $salles
        ]);
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'salles' => 'required'
        ]);
        $manifestation = new Manifestation();
        $manifestation->theme = $request->theme;
        $manifestation->slug = str_replace(' ', '-', $request->theme);
        $manifestation->start_date = $request->start_date;
        $manifestation->end_date = $request->end_date;
        $manifestation->save();

        foreach ($request->salles as $salle) {
            $manifestation->salles()->attach($salle);
        }
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('manifestations.index');
    }
    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'theme' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'salles' => 'required'
        ]);
        $manifestation = Manifestation::find($id);
        $manifestation->theme = $request->theme;
        $manifestation->slug = str_replace(' ', '-', $request->theme);
        $manifestation->start_date = $request->start_date;
        $manifestation->end_date = $request->end_date;
        $manifestation->save();
        // dd($request->salles);
        foreach ($request->salles as $salle) {
            $manifestation->salles()->syncWithoutDetaching($salle);
        }
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('manifestations.index');
    }
    // destroy 
    public function destroy($id)
    {
        $manifestation = Manifestation::find($id);
        $manifestation->delete();
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('manifestations.index');
    }
    // detach salle
    public function detachSalle($id,Request $request)
    {
        $manifestation = Manifestation::find($id);
        $manifestation->salles()->detach($request->salle_id);
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('manifestations.index');
    }
}
