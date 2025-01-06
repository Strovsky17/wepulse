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

class DatabaseService {

    /**
     * Create a new database
     */
    public static function create( $db_database )
    {
        DB::statement("CREATE database $db_database");
    }

    /**
     * Create the migration of the DB
     */
    public static function migration( $debug = false  )
    {
        //dd(DB::connection('app')->getDatabaseName());

        // Verified if migration table exist
        if (!Schema::connection('app')->hasTable('migrations')) 
        {
            Schema::connection('app')->create('migrations', function($table)
            {
                   $table->increments('id');
                   $table->string('migration', 90);
            });
       }

       $filesName = File::files(base_path().'\database\migrations\app\\');
       foreach ($filesName as $f) 
       {
            $name = pathinfo($f, PATHINFO_FILENAME);
            $m = DB::connection('app')->table('migrations')->where( 'migration', $name )->first();
            
            if( !$m )
            {
                try
                {
                    // Exec File
                    $x = require base_path().'\database\migrations\app\\'.$name.'.php';
                    $x->up();

                    // Save On DB
                    DB::connection('app')->table('migrations')->insert( ['migration' => $name] );

                    if( $debug )
                    {
                        echo '----------------<br>';
                        echo 'File - '.$name.'<br>';
                        echo '----------------<br>';
                    }
                } 
                catch (\Throwable $th) 
                {
                    if( $debug )
                    {
                        echo '----------------<br>';
                        echo 'File - '.$name.' - Error<br>';
                        echo '----------------<br>';
                    }
                }
            }
       }
    }

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
        ]);

        DB::purge('app');
    }
}
