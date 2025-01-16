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
        Schema::connection('app')->table('assets', function (Blueprint $table) {

            $table->dropColumn('category');
            $table->unsignedBigInteger('category_id');

            // Relations
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('app')->dropIfExists('categories');
    }
};
