<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Profile;

class ClientController extends Controller
{
    /**
     * Page Profile
     */
    function profile()
    {
        $profile = Profile::all();
        $profile = array_reduce( $profile->toArray(), function($a, $b) {
            $a[$b['code']] = $b['value'];
            return $a;
        }, []);

        return view( 'client.profile', [ 'profile' => $profile ] );
    }
}
