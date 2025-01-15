<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Asset;

class AssetsController extends Controller
{
    /**
     * Page to create assets personal fields
     */
    function fields()
    {
        $fields = Field::all();

        return view( 'assets.fields.view', ['fields' => $fields] );
    }

    /**
     * Create a new Asset
     */
    function list()
    {
        $assets = Asset::all();
        return view( 'assets.assets.list', [ 'assets' => $assets ]);
    }
    
    /**
     * Create a new Asset
     */
    function create()
    {
        return view( 'assets.assets.view', [ 'asset' => [] ]  );
    }

     /**
     * Edit a Asset
     */
    function edit( $id )
    {
        $asset = Asset::find($id);
        return view( 'assets.assets.view', [ 'asset' => $asset ] );
    }



    



    function ativos()
    {
        return view( 'ativos.active' );
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
        return view( 'ativos.history.history' );
    }
    
    function inventory()
    {
        return view( 'ativos.inventory' );
    }
    function category()
    {
        return view( 'assets.category' );
    }
    
}
