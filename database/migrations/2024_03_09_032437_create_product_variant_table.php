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
        Schema::create('product_variant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product'); // tạo khóa ngoại liên kết bảng
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('color');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('id')->on('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant');
    }
};
