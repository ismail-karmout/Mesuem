<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubscribersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    // index 
    public function index()
    {
        $subscribers = User::where('role', 'subscriber')->withTrashed()->orderBy('created_at', 'desc')->paginate('10');
        return view('admin.subscribers.index', [
            'subscribers' => $subscribers
        ]);

    }
    //destroy soft delete
    public function destroy($id)
    {
        $subscriber = User::find($id);
        $subscriber->delete();
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->route('subscribers.index');
    }
    //restore soft delete
    public function restore($id)
    {
        $subscriber = User::withTrashed()->find($id);
        $subscriber->restore();
        Alert::toast("L'opération a été effectuée avec succès", 'success');

        return redirect()->route('subscribers.index');
    }
    
}
