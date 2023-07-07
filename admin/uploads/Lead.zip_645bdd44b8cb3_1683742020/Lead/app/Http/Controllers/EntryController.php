<?php

namespace App\Http\Controllers;
use App\Models\Entries;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EntryController extends Controller
{

public function index()
{   $user = Auth::user();
    if ($user->Role == 'writer') {
        return redirect('/createEntry');
    }
    $Entries = Entries::all();
    return view('dashboard.allrecords', ['Entries' => $Entries]);
}


public function show($id)
{
    $entry = Entries::find($id);
    if (!$entry) {
        abort(404);
    }
    // Update status to viewed
    $entry->status = 'viewed';
    $entry->save();


    $userID = Auth::id();
    $log = Logs::create([
        'user_id' => $userID,
        'entry_id' => $id
    ]);

    $logs = DB::table('logs')
    ->join('users', 'logs.user_id', '=', 'users.id')
    ->select('users.name', 'logs.created_at')
    ->where('logs.entry_id', $id)
    ->get();

    return view('dashboard.entryView', ['entry' => $entry,'logs'=> $logs]);
}

public function create()
{
    return view('dashboard.createView');
}

public function store(Request $request)
{
    try {
        $entry = new Entries;
        $entry->name = $request->input('name');
        $entry->email = $request->input('email');
        $entry->website = $request->input('website');
        $entry->phone = $request->input('phone');
        $entry->linkedin = $request->input('linkedin');
        $entry->address = $request->input('address');
        $entry->category = $request->input('category');
        $entry->facebook = $request->input('facebook');
        $entry->instagram = $request->input('instagram');
        $entry->whatsapp = $request->input('whatsapp');
        $entry->other = $request->input('other');
        $entry->description = $request->input('description');
        $entry->save();
        
        return response()->json(['message' => 'Entry created successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error creating entry: ' . $e->getMessage()], 500);
    }
}
public function createUser()
{
    return view('dashboard.createUser');

}

public function createUserPOST(Request $request)
{
    try {
        $entry = new User;
        $entry->name = $request->input('name');
        $entry->email = $request->input('email');
        $entry->password = bcrypt($request->input('password'));
        $entry->Role = $request->input('role_id');
        $entry->save();
        return response()->json(['message' => 'User created successfully'], 200);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Error creating user: ' . $e->getMessage()], 500);
    }
}


}