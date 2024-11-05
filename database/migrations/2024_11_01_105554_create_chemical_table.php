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
        Schema::create('chemical', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id'); // Foreign key for material
            $table->string('chemical')->default(''); // Chemical name or type as string
            $table->float('start', 5, 2)->default(0.0); // Floating point with precision
            $table->float('end', 5, 2)->default(0.0); // Floating point with precision
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
        Schema::dropIfExists('chemical');
    }
};
