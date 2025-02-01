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
        Schema::create('medicines_master', function(Blueprint $table){
            $table->id();
            $table->longText('brand_name');
            $table->longText('molecule');
            $table->longText('dosage_form');
            $table->longText('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('medicines_master');
    }
};
