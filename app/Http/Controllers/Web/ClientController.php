<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserClient;


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

        $client_id = Session::get('client_id');
        
        $users = [];
        $uc = UserClient::where('client_id', $client_id)->pluck('user_id')->toArray();
        if( !empty( $uc) )
        {
            $users = User::whereIn('id', $uc)->get();
            $users->append(['roleClient']);
        }

        return view( 'client.profile', [ 'profile' => $profile, 'users' => $users ] );
    }
}
