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
        Schema::create('patients', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('household')->nullable();
            $table->bigInteger('phone')->unique()->nullable();
            $table->string('age');
            $table->string('gender');
            $table->string('address');
            $table->date('a_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       //
        Schema::dropIfExists('patients');
    }
};
