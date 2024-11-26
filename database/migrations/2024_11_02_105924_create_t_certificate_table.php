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
        Schema::create('t_certificate', function (Blueprint $table) {
            $table->id();
            $table->string('c_no')->unique(); // Certificate number, unique string
            $table->unsignedBigInteger('product_id'); // Foreign key for product
            $table->string('size')->default(''); // Size, string with default empty
            $table->string('heat_no')->default(''); // Heat number, string with default empty
            $table->string('serial')->default(''); // Serial number, string with default empty
            $table->integer('quantity')->default(0); // Quantity, integer with default 0
            $table->string('drawing_no')->default(''); // Drawing number, string with default empty
            $table->string('customer')->default(''); // Customer name, string with default empty
            $table->string('auth_signatory')->default(''); // Authorized signatory, string with default empty
            $table->string('inspect_signatory')->default(''); // Inspector signatory, string with default empty
            $table->string('manufacture_process')->default(''); // Manufacture process, string with default empty
            $table->string('tcd')->default(''); // TCD, string with default empty
            $table->string('reduction')->default(''); // Reduction, string with default empty
            $table->string('size_2')->default(''); // Second size measurement, string with default empty
            $table->text('notes')->nullable(); // Notes, text with nullable
            $table->string('hardness')->default(''); // Hardness value, string with default empty
            $table->string('maker_name')->default(''); // Maker's name, string with default empty
            $table->boolean('edited')->default(false); // Edited flag, boolean to indicate if edited
            $table->timestamps();
    
            // Foreign key constraint to link product_id to product table
            // $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate');
    }
};
