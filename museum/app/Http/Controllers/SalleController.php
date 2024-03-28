<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SalleController extends Controller
{
    // index
    public function index()
    {
        $salles = Salle::with('artworks:id,salle_id,title,image')->orderBy('created_at', 'desc')->paginate('10');
        return view('admin.salles.index', [
            'salles' => $salles
        ]);
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'capacity' => 'required'
        ]);
        $salle = new Salle();
        $salle->name = $request->name;
        $salle->slug = str_replace(' ', '-', $request->name);

        $salle->description = $request->description;
        $salle->capacity = $request->capacity;
        $salle->save();
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('salles.index');
    }
    // update
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'capacity' => 'required'
        ]);
        $salle = Salle::find($id);
        $salle->name = $request->name;
        $salle->slug = str_replace(' ', '-', $request->name);
        $salle->description = $request->description;
        $salle->capacity = $request->capacity;
        $salle->save();

        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('salles.index');
    }

}
