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
        Schema::table('product_variant', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id_quanity');
            $table->foreign('id_quanity')->references('id')->on('quanity');
        });
        //
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('product_variant', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id_quanity');
            $table->dropForeign('id_quanity')->references('id')->on('quanity');
        });
    }
};
