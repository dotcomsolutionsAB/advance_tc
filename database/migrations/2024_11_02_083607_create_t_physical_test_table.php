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
        Schema::create('t_physical_test', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->float('elongation_start', 8, 2)->default(0); // Floating point with precision
            $table->float('elongation_end', 8, 2)->default(0);
            $table->float('tensile_start', 8, 2)->default(0); // Floating point with precision
            $table->float('tensile_end', 8, 2)->default(0);
            $table->float('yield_start', 8, 2)->default(0); // Floating point with precision
            $table->float('yield_end', 8, 2)->default(0);
            $table->timestamps();

            // $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');
       
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_test');
    }
};
