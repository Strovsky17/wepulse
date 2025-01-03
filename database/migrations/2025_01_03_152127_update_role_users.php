<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role',19);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

DatabaseService::changeAppConnection( ["database" => "wepulse_1"] );
DatabaseService::migration();

DatabaseService::changeAppConnection( ["database" => "wepulse_2"] );
DatabaseService::migration();

dd("AAAA");