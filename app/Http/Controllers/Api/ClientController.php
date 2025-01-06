<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;

use App\Services\DatabaseService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
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
        if( !$user || $user->role != 'superadmin' )
            return abort(401);
        
        // Validated fields
        $validated = Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();

        // Create client
        $client = Client::create([
            'name' => $request->name,
            'token' => str()->random(30)
        ]);

        // Database
        DatabaseService::create( "wepulse_".$client->id );
        DatabaseService::changeAppConnection( ["database" => "wepulse_".$client->id] );
        DatabaseService::migration();

        return $client;
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
