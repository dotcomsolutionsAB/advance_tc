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
        Schema::create('t_dimensional', function (Blueprint $table) {
            $table->id();
            $table->integer('mtc_id');
            $table->integer('mtc_items_id');
            $table->string('qty_checked');
            $table->enum('type', ['reducer', 'tee', 'elbow', 'flange']); 
            $table->string('od_target_end');
            $table->string('od_small_end');  
            $table->string('thickness');  
            $table->string('end_to_end_length');
            $table->string('od');
            $table->string('thk');
            $table->string('center_to_end');
            $table->string('outside_diameter');
            // $table->string('thickness');
            $table->string('run');
            $table->string('outlet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_dimensional');
    }
};
