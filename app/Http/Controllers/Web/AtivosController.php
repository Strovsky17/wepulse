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
        return view( 'ativos.geralregister' );
    }
    function alerts()
    {
        return view( 'ativos.geralalerts' );
    }
    function history()
    {
        return view( 'ativos.history' );
    }
    function edit()
    {
        return view( 'ativos.geraledit' );
    }
    function inventory()
    {
        return view( 'ativos.inventory' );
    }
    
}
