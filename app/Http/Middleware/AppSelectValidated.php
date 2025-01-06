<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Services\DatabaseService;

use Symfony\Component\HttpFoundation\Response;

class AppSelectValidated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client_id = Session::get('client_id');
        $user = Auth::user();

        if(  !$user )
        {
            return redirect('/login');
        }
        else
        {
            if( !$client_id )
            {
                if( $user->role == 'superadmin' )
                {
                    return redirect('/admin');
                }
                else
                {
                    dd('Escolher a primeira base de dados');
                }
            }
            else
            {
                DatabaseService::changeAppConnection( ["database" => "wepulse_".$client_id] );
            }
        }

        return $next($request);
    }
}
