<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ConferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    //index
    public function index(Request $request)
    {

        $conferences = Conference::with('conferencier:id,name')
            ->get();
        $events = [];
        foreach ($conferences as $conference) {
            array_push($events, [
                'id' => $conference->id,
                'title' => $conference->sujet . ' - ' . $conference->conferencier->name . ' - salle de conférence',
                'start' => $conference->date,
                // random color for each event

                'color' =>  '#' . substr(md5(mt_rand()), 0, 6)
            ]);
        }

        $conferenciers = User::where('role', 'conferencier')->get();
        return view(
            'admin.conferences.index',
            [
                'events' => json_encode($events),
                'conferenciers' => $conferenciers,
            ]
        );
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'conferencie_id' => 'required',
            'sujet' => 'required',
            'date' => 'required',
        ]);
        Conference::create([
            'conferencie_id' => $request->conferencie_id,
            'salle_id' => 3,
            'sujet' => $request->sujet,
            'date' => $request->date,
        ]);
        Alert::toast("L'opération a été effectuée avec succès", 'success');
        return redirect()->route('conferenciers.index');
    }
    //update
    public function update(Request $request, $id)
    {

        $event = Conference::find($request->id)->update([
            'title' => $request->title,
            'date' => $request->start,
        ]);
        return response()->json($event);
        // return redirect()->route('conferences.index')->with('success', 'Conference updated successfully');
    }
    // delete
    public function destroy($id)
    {
        $conference = Conference::find($id);
        $conference->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event removed successfully.'
        ]);
    }
}
