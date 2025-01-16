<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\History;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'name' => 'required'
        ])->validate();

        // Create client
        $History = History::create([
            'name' => $request->name
        ]);

        return $History;
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

        $History = History::find($id);

        if( isset($request->name) )
            $History->name = $request->name;

        $History->save();

        return $History;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        History::find($id)->delete();
    }
}