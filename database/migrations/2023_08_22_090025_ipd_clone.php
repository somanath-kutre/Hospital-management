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
        Schema::create('ipd_clone', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('opd_number');
            $table->unsignedBigInteger('admission_id');
            $table->string('name');
            $table->string('admission_type');                                     
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('opd_number')->references('id')->on('patients_clone');
            $table->foreign('patient_id')->references('id')->on('patients');//foreign key of patients id
            $table->foreign('admission_id')->references('id')->on('admission');//foreign key of patients id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('ipd_clone');
    }
};
