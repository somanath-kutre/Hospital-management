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
        //
        Schema::create('summary', function(Blueprint $table){
            $table->id();
            $table->bigInteger('admission_id')->unsigned();
            $table->longText('summary');
            $table->timestamps();
            $table->foreign('admission_id')->references('id')->on('admission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('summary');
    }
};
