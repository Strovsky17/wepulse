<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Field;

class AssetsController extends Controller
{
    /**
     * Page to create assets personal fields
     */
    function fields()
    {
        $fields = Field::all();

        return view( 'assets.fields.view', ['fields' => $fields] );
    }

     







    function ativos()
    {
        return view( 'ativos.active' );
    }
    function register()
    {
        return view( 'ativos.register.register' );
    }
    function alerts()
    {
        return view( 'ativos.alerts.alert' );
    }
    function history()
    {
        return view( 'ativos.history.history' );
    }
    function edit()
    {
        return view( 'ativos.edit.edit' );
    }
    function inventory()
    {
        return view( 'ativos.inventory' );
    }
    
    
}
