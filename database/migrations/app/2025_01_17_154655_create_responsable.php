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
        Schema::connection('app')->create('responsable', function (Blueprint $table) {
            $table->id();
            $table->string('name', 99);
            $table->string('email', 99);
            $table->integer('contact');
            $table->string('departmentcompany', 99);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('app')->dropIfExists('responsable');
    }
};
