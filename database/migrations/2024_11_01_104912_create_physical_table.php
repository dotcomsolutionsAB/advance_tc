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
        Schema::create('physical', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id'); // Foreign key for material
            $table->float('temperature', 8, 2)->default(0); // Floating point with precision
            $table->float('pressure_start', 8, 2)->default(0); // Floating point with precision
            $table->float('pressure_end', 8, 2)->default(0); // Floating point with precision
            $table->timestamps();
            
            // Foreign key constraint to link material_id to material table
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical');
    }
};
