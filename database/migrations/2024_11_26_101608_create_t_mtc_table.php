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
        Schema::create('t_mtc', function (Blueprint $table) {
            $table->id();
            $table->integer('customer');
            $table->string('order_no');
            $table->date('order_date');
            $table->string('inspection_authority');  
            $table->string('qap_no');  
            $table->string('place_of_inspection');
            $table->string('qap_clause');
            $table->string('certificate_no');
            $table->string('certificate_date');
            $table->string('edition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_mtc');
    }
};
