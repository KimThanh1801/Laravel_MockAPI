<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // UNSIGNED BIGINT AUTO_INCREMENT
            $table->string('name', 100)->nullable();
            $table->unsignedBigInteger('id_type')->nullable();
            $table->text('description')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('promotion_price')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('unit', 255)->nullable();
            $table->tinyInteger('new')->default(0);
            $table->timestamps();

            // Nếu có bảng product_types, ta thêm khóa ngoại
            $table->foreign('id_type')->references('id')->on('product_types')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
