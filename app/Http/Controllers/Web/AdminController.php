<?php

namespace App\Http\Controllers\Web;

use App\Models\User;

use App\Services\DatabaseService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Page Admin
     */
    function admin()
    {
        $user = Auth::user();

        // Not a log user
        if( !$user )
            return view( 'login' );

        // Only superamin is allowed
        if( $user->role != 'superadmin' )
            return abort(401);

        return view( 'admin/view' );
    }
}
