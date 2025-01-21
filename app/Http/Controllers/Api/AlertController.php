<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use DB;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alert::orderBy('date', 'desc');

        if( !empty( $request->asset_id ) )
            $query = $query->where('asset_id', $request->asset_id);

        if( !empty($request->search) )
        {
            $s = $request->search;
            $a = $request->asset_id;

            $query = $query->where( function ($q) use ($s, $a) {

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
            'status' => 'required',
            'description' => 'required',
        ])->validate();

        // Create client
        $Alert = Alert::create([
            'status' => $request->status,
            'date' => $request->date,
            'description' => $request->description,
            'asset_id' => $request->asset_id,
            'obs' => $request->obs ?? ''
        ]);

        return $Alert;
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

        $Alert = Alert::find($id);

        if( isset($request->asset_id) )
            $Alert->asset_id = $request->asset_id;
        
        if( isset($request->status) )
            $Alert->status = $request->status;
        
        if( isset($request->date) )
            $Alert->date = $request->date;
        
        if( isset($request->description) )
            $Alert->description = $request->description;
        
        if( isset($request->obs) )
            $Alert->obs = $request->obs;

        $Alert->save();
        $Alert->asset;

        return $Alert;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Alert::find($id)->delete();
    }
}