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
        Schema::create('alert', function (Blueprint $table) {
            $table->id();
            $table->string('type', 99);
            $table->string('asset', 99);
            $table->string('category', 99);
            $table->integer('date');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert');
    }
};
