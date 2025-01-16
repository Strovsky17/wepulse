<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Asset;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
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
        
        // Validated fields
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'risk' => 'required',
            'criticality' => 'required',
            'data' => 'required',
        ])->validate();

        // Create client
        $asset = Asset::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'risk' => $request->risk,
            'criticality' => $request->criticality,
            'data' => $request->data ?? [],
        ]);

        return $asset;
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
        
        // Validated fields
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'risk' => 'required',
            'criticality' => 'required',
            'data' => 'required',
        ])->validate();

        $asset = Asset::find($id);

        if( isset($request->name) )
            $asset->name = $request->name;

        if( isset($request->category_id) )
            $asset->category_id = $request->category_id;

        if( isset($request->risk) )
            $asset->risk = $request->risk;

        if( isset($request->criticality) )
            $asset->criticality = $request->criticality;

        if( isset($request->data) )
            $asset->data = $request->data;

        $asset->save();

        return $asset;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Asset::find($id)->delete();
    }
}

