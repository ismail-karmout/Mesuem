<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TarifController extends Controller
{
    // index 
    public function index()
    {
        $tarifs = Tarif::all();
        return view(
            'admin.tarifs.index',
            [
                'tarifs' => $tarifs,

            ]
        );
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'tarif' => 'required|min:1|numeric',
            'tarif_reduit' => 'required|numeric|min:0|max:100',
        ]);
        Tarif::create($request->all());
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('tarifs.index')->with('success', 'Tarif créé avec succès');
    }
    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'tarif' => 'required|min:1|numeric',
            'tarif_reduit' => 'required|numeric|min:0|max:100',
        ]);
        $tarif = Tarif::find($id);
        $tarif->update($request->all());
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->route('tarifs.index')->with('success', 'Tarif modifié avec succès');
    }
    // destroy
    public function destroy($id)
    {
        $tarif = Tarif::find($id);
        $tarif->delete();
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->route('tarifs.index')->with('success', 'Tarif supprimé avec succès');
    }
}
