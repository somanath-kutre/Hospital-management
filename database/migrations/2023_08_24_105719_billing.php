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
        Schema::create('billing', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('admission_id');
            $table->string('description');
            $table->string('category');
            $table->bigInteger('amount')->nullable();
            $table->string('admission_type');            
            $table->integer('qty');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admission_id')->references('id')->on('admission');//foreign key of admission id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('billing');
    }
};
