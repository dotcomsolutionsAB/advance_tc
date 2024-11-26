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
        Schema::create('t_mpe', function (Blueprint $table) {
            $table->id();
            $table->integer('mtc_id');
            $table->string('testing_equipment');
            $table->string('magnetic_particle');
            $table->string('wet_dry');  
            $table->string('color');
            $table->string('magnetizing_process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_mpe');
    }
};
