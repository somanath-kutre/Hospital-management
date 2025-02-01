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
        Schema::create('prescription',function (Blueprint $table){
            $table->id();
            $table->bigInteger('admission_id')->unsigned(); // Unsigned to match the 'id' column in 'admission'
            $table->longText('prescription');
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
        Schema::dropIfExists('prescription');
    }
};
