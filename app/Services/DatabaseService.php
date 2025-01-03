<?php

namespace App\Services;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

use App\Models\Automation;

use Config;
use DB;
use File;
use Route;

class DatabaseService {

    /**
     * Create the migration of the DB
     */
    public static function migration()
    {
        // Verified if migration table exist
        if (!Schema::connection('app')->hasTable('migrations')) 
        {
            Schema::connection('app')->create('migrations', function($table)
            {
                   $table->increments('id');
                   $table->string('migration', 90);
            });
       }
    }

    /*$x = require base_path().'\database\migrations\0001_01_01_000000_create_users_table.php';
    $x->up();
    
    dd("AAAA");

    $filesName = File::files(base_path().'\database\migrations\app\\');
    dd($filesName);*/

    /**
     * Change APP database connection
     */
    public static function changeAppConnection( $DB )
    {
        // Add new connection
        Config::set("database.connections.app", [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'database' => $DB['database'],
            /*'driver' => $DB->driver,
            'host' => $DB->db_host,*/
            /*'username' => $DB->db_username,
            'password' => $pass,
            'port' => $DB->port*/
        ]);

        DB::purge('app');
    }
}
