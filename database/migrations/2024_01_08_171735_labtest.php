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
        Schema::create('labtest', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('opd_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('admission_id');
            $table->string('test_name');
            $table->string('category');
            $table->string('department');
            // $table->timestamps();
            // $table->softDeletes();
            $table->foreign('opd_id')->references('id')->on('patients_clone');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('admission_id')->references('id')->on('admission');
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('labtest');
    }
};
