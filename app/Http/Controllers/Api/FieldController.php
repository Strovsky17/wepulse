<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Field;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FieldController extends Controller
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
            'required' => 'required',
            'type' => 'required',
        ])->validate();

        // Create client
        $field = Field::create([
            'name' => $request->name,
            'description' => $request->description ?? '',
            'type' => $request->type,
            'required' => $request->required,
            'data' => $request->data ?? [],
        ]);

        return $field;
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

        $field = Field::find($id);

        if( isset($request->name) )
            $field->name = $request->name;

        if( isset($request->description) )
            $field->description = $request->description;
        
        if( isset($request->required) )
            $field->required = $request->required;
        
        if( isset($request->data) )
            $field->data = $request->data;
        
        if( isset($request->type) )
            $field->type = $request->type;

        $field->save();

        return $field;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Field::find($id)->delete();
    }
}
