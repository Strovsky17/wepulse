<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Page Profile
     */
    function profile()
    {
        return view( 'client.profile' );
    }
    
}

{
    function info(){
        return view('client.info');

    }

}
