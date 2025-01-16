<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Category;
use App\Models\History;
use App\Models\Asset;
use App\Models\Alert;

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

    /**
     * Create a new Category
     */
    function categories()
    {
        $categories = Category::all();
        return view( 'assets.categories.view', ['categories' => $categories] );
    }

     /**
     * Create a new History
     */
    function histories()
    {
        $histories = History::all();
        return view( 'assets.histories.view', ['histories' => $histories] );
    }

    /**
     * Create a new Alert
     */
    function alerts()
    {
        $alerts = Alert::all();
        return view( 'assets.alerts.view', ['alerts' => $alerts] );
    }

    







    function ativos()
    {
        return view( 'ativos.active' );
    }
    function register()
    {
        return view( 'ativos.register.register' );
    }
    function history()
    {
        return view( 'ativos.history.history' );
    }
    
    function inventory()
    {
        return view( 'ativos.inventory' );
    }

    function assets()
    {
        return view( 'assets.assets.list' );
    }   
}
