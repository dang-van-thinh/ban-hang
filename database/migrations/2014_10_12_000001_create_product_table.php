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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('price',15,2); // lưu trư với giá tiền lên đến đơn vị tỉ đồng
            $table->integer('quanity');
            $table->integer('quanity_sale');
            $table->timestamps();
            $table->mediumText('description');
            $table->integer('rating');
            $table->string('img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
