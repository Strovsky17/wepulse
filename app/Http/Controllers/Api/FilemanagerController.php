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

        return 'files/'.$path;
    }
    
    /**
     * Get image form WB
     */
    public function getFile( $number, $id )
    {
        // GEt all meta numbers
        /*$wbs = Api::where('token', 'wb')->get();
        foreach ($wbs as $wb)
        {
            if( !empty($wb->data) && !empty($wb->data['phone_number_id']) && ( $number == 0 || $number == $wb->data['phone_number_id'] ))
            {
                $service = new WBService($wb->id);
                $service->getFile( $id );
                return;
            }
        }

        $service = new WBService();
        $service->getFile( $id );*/
    }
}
