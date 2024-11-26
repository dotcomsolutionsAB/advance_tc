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
        Schema::create('t_mtc_items', function (Blueprint $table) {
            $table->id();
            $table->integer('mtc_id');
            $table->string('product');
            $table->string('material_code');
            $table->integer('quantity');  
            $table->string('heat_no');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_mtc_items');
    }
};
