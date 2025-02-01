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
        Schema::create('patients_clone', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('admission_id');
            $table->string('name');
            $table->string('household')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('age');
            $table->string('gender');
            $table->string('address');
            $table->date('a_date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('admission_id')->references('id')->on('admission');//foreign key of patients id
            $table->foreign('patient_id')->references('id')->on('patients');//foreign key of patients id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('patients_clone');
    }
};
