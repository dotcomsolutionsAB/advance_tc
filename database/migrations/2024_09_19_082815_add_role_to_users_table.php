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
        Schema::table('users', function (Blueprint $table) {
            // $table->string('username');
           
                if (!Schema::hasColumn('users', 'username')) {
                    $table->string('username')->after('id');
                }
                if (!Schema::hasColumn('users', 'role')) {
                    $table->enum('role', ['admin', 'user'])->default('user');
                }  
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('mobile')->unique();
                }           
               
            // $table->enum('role', ['admin', 'user'])->default('user');  // Add role field
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('mobile');
            $table->dropColumn('role');
        });
    }
};
