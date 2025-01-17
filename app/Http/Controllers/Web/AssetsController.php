<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Category;
use App\Models\History;
use App\Models\Asset;
use App\Models\Alert;
use App\Models\Responsable;

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
        $categories = Category::all();

        return view( 'assets.assets.list', [ 'assets' => $assets, 'categories' => $categories ]);
    }
    
    /**
     * Create a new Asset
     */
    function create()
    {
        $fields = Field::all();
        $categories = Category::orderBy('name')->get();

        return view( 'assets.assets.view', [ 'asset' => [], 'categories' => $categories, 'fields' => $fields ]  );
    }

     /**
     * Edit a Asset
     */
    function edit( $id )
    {
        $asset = Asset::find($id);
        $fields = Field::all();
        $categories = Category::orderBy('name')->get();

        return view( 'assets.assets.view', [ 'asset' => $asset, 'categories' => $categories, 'fields' => $fields ] );
    }

    /**
     * Create a new Category
     */
    function categories()
    {
        $categories = Category::orderBy('name')->get();

        return view( 'assets.categories.view', ['categories' => $categories] );
    }

     /**
     * Create a new History
     */
    function histories()
    {
        //$histories = History::all();
        $histories = [];
        return view( 'assets.histories.view', ['histories' => $histories] );
    }

    /**
     * Create a new Alert
     */
    function alerts()
    {
        //$alerts = Alert::all();
        $alerts = [];
        return view( 'assets.alerts.view', ['alerts' => $alerts] );
    }

    function responsables()
    {
        //$responsables = Responsable::all();
        $responsables = [];
        return view( 'assets.responsables.view', ['responsables' => $responsables] );
    }
}
