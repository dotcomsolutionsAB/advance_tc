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
        Schema::create('t_lpi', function (Blueprint $table) {
            $table->id();
            $table->integer('mtc_id');
            $table->string('title');
            $table->enum('type', ['reducer', 'tee', 'elbow', 'flange']); 
            $table->string('batch_no');  
            $table->date('mfg_date');  
            $table->date('expiry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_lpi');
    }
};
