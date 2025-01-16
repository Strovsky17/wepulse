<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\WBService;

use App\Models\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FilemanagerController extends Controller
{
    /**
     * Upload files
     */
    public function upload( Request $request )
    {
        // Valited User
        $user = Auth::user();
        if( $user && ( $user->role == 'superadmin' || $user->roleClient == 'admin' )  ) {} else
            return abort(401);

        $client_id = Session::get('client_id');
        if( $client_id == null )
            return abort(401);

        // File Validate Type
        $file = $request->file('file');
        $type = $file->getMimeType();

        $types = ['image/jpeg','image/png','image/jpg','application/pdf'];
        if( !in_array( $type, $types ) )
            return response()->json( ["message" => __('filemanager.invalidformat')], 403);

        $path = $request->file('file')->store(
            $client_id.'/'.$user->id, 'local'
        );

        return 'uploads/'.$path;
    }
    
    /**
     * Get image form WB
     */
    public function get( $client_id, $user_id, $file )
    {
        // Valited User
        $user = Auth::user();
        if( $user && ( $user->role == 'superadmin' || $user->roleClient == 'admin' )  ) {} else
            return abort(401);

        if( Session::get('client_id') != $client_id )
            return abort(401);

        $mimeType = Storage::mimeType($client_id.'/'.$user_id.'/'.$file );
        if( empty($mimeType) )
            return abort(404);

        $content = Storage::get( $client_id.'/'.$user_id.'/'.$file );
    
        header('Content-type: '.$mimeType);
        echo $content;
        die('');
    }
}
