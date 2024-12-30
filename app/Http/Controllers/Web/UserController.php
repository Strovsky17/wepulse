<?php

namespace App\Http\Controllers\Web;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Page Login
     */
    function login()
    {
        if( Auth::user() )
            return redirect('/dashboard');

        return view( 'login' );
    }
    
    /**
     * Page Dashboard
     */
    function dashboard()
    {
        return view( 'dashboard' );
    }
}
