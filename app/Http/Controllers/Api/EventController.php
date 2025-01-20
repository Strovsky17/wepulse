<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::orderBy('date', 'desc');

        if( !empty( $request->asset_id ) )
            $query = $query->where('asset_id', $request->asset_id);

        if( !empty($request->search) )
        {
            $s = $request->search;
            $a = $request->asset_id;

            $query = $query->where( function ($q) use ($s, $a) {

                $q->where('who', 'LIKE', "%$s%" );
                $q->orWhere('description', 'LIKE', "%$s%" );
                $q->orWhere('obs', 'LIKE', "%$s%" );

                if( empty($a) )
                {
                    $q->orWhereRaw( DB::raw(" asset_id in ( SELECT id FROM assets WHERE name LIKE '%$s%'  )", ''));
                }

            });
        }

        return $query->paginate(15);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valited User
        $user = Auth::user();
        if( $user && ( $user->role == 'superadmin' || $user->roleClient == 'admin' )  ) {} else
            return abort(401);
        
        // Validated Historires
        $validated = Validator::make($request->all(), [
            'asset_id' => 'required',
            'date' => 'required',
            'who' => 'required',
            'description' => 'required',
        ])->validate();

        // Create client
        $Event = Event::create([
            'who' => $request->who,
            'date' => $request->date,
            'description' => $request->description,
            'asset_id' => $request->asset_id,
            'obs' => $request->obs ?? '',
            'next_event' => $request->next,
            'guatantee' => $request->guatantee,
        ]);

        return $Event;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valited User
        $user = Auth::user();
        if( $user && ( $user->role == 'superadmin' || $user->roleClient == 'admin' )  ) {} else
            return abort(401);

        $Event = Event::find($id);

        if( isset($request->asset_id) )
            $Event->asset_id = $request->asset_id;
        
        if( isset($request->who) )
            $Event->who = $request->who;
        
        if( isset($request->date) )
            $Event->date = $request->date;
        
        if( isset($request->description) )
            $Event->description = $request->description;
        
        if( isset($request->obs) )
            $Event->obs = $request->obs;
        
        if( isset($request->next) )
            $Event->next_event = $request->next;
        
        if( isset($request->guatantee) )
            $Event->who = $request->guatantee;

        $Event->save();
        $Event->asset;

        return $Event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::find($id)->delete();
    }
}