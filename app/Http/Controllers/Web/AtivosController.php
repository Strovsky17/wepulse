<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AtivosController extends Controller
{
    /**
     * Page Profile
     */
    function ativos()
    {
        return view( 'ativos.ativos' );
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
        return view( 'ativos.history' );
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
