<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\User;
use App\Models\UserClient;

use App\Services\DatabaseService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Remove the specified resource from storage.
     */
    public function change(Request $request)
    {
        $client = Client::where('token', $request->token)->first();
        if( $client )
        {
            Session::put('client_id', $client->id );
            return ['success' => true];
        }

        return abort(404);
    }

    /**
     * Add profile info to the client
     */
    public function profile(Request $request)
    {
        // Valited User
        $user = Auth::user();
        if( !$user || $user->role != 'superadmin' )
            return abort(401);

        $data = $request->all();
        foreach ($data as $code => $value) 
        {
            $p = Profile::where('code', $code)->first();
            if( $p )
            {
                $p->value = $value;
                $p->save();
            }
            else
            {
                Profile::create([
                    'code' => $code,
                    'value' => $value
                ]);
            }
        }

        return ['success' => true];
    }
    
    /**
     * Add User
     */
    public function addUser(Request $request)
    {
        // Valited User
        $ua = Auth::user();
        if( $ua && ( $ua->role == 'superadmin' || $ua->roleClient == 'admin' ) ) {} else
            return abort(401);

        $client_id = Session::get('client_id');

        // Validated fields
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ])->validate();
        
        $user = User::where('email', $request->email)->first();
        if( $user )
        {   
            $user->name = $request->name;
            //$user->phone = empty($request->phone) ? $user->phone : $request->phone;
            $user->save();
        }
        else
        {
            // Validated fields
            $validated = Validator::make($request->all(), [
                'password' => 'required',
            ])->validate();

            // Create new user and new client relations
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // 'phone' => empty($request->phone) ? '' : $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'client',
            ]);
        }

        $uc = UserClient::where('user_id', $user->id)->where('client_id', $client_id)->first();
        if( !$uc )
        {
            UserClient::create([
                'user_id' => $user->id,
                'client_id' => $client_id,
                'role' => $request->role,
            ]);
        }
        else
        {
            $uc->role = $request->role;
            $uc->save();
        }

        $user->roleClient;
        return $user;
    }
}
