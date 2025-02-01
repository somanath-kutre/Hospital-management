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
        Schema::create('cloned_recipts', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('admission_id');
            $table->unsignedBigInteger('opd_number');
            $table->bigInteger('amount')->nullable();;
            $table->string('p_mode');
            $table->string('descr');
            $table->timestamps();
            $table->foreign('admission_id')->references('id')->on('admission');
            $table->foreign('opd_number')->references('id')->on('patients_clone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('cloned_recipts');
    }
};
