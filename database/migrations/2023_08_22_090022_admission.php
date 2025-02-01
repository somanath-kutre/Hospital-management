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
        Schema::create('admission', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('admission_type');
            $table->string('doctor')->nullable();
            $table->string('refer_doc')->nullable();
            $table->string('operation_name')->nullable();
            $table->date('operation_date')->nullable();
            $table->integer('fees')->nullable();;
            $table->integer('discount')->nullable();
            $table->integer('paid')->nullable();
            $table->integer('advance')->nullable();
            $table->string('p_mode');
            $table->boolean('discharge');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients');//foreign key of patients id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('admission');
    }
};
