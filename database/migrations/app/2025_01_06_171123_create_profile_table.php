<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected  $connections = 'app';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('app')->create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30);
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('app')->dropIfExists('profile');
    }
};
