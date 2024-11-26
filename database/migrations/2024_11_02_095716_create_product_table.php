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
        Schema::create('t_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');  // Foreign key to 'material' table, assuming an integer ID
            $table->string('alpha')->default('');
            $table->string('name')->default('');
            $table->string('print_name')->default('');
            $table->string('md_1')->default('');  // Using snake_case for consistency if needed
            $table->string('md_2')->default('');
            $table->string('raw')->default('');
            $table->string('specifications')->default('');
            $table->string('template')->default('');
            $table->string('temperature')->default('');
            $table->timestamps();
            
            // If you want to define a foreign key relationship with 'material' table
            // $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
