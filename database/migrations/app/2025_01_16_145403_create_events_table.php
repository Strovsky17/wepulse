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
        Schema::connection('app')->create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->timestamp('date')->nullable();
            $table->string('who', 99);
            $table->string('description', 99);
            $table->text('obs');
            $table->timestamp('next_event')->nullable();
            $table->timestamp('guatantee')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');

            // Relations
            $table->foreign('asset_id')->references('id')->on('assets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('app')->dropIfExists('events');
    }
};
