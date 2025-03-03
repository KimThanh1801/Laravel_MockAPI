<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bill_detail', function (Blueprint $table) {
            $table->id(); // Tự động tạo cột id (UNSIGNED INT)
            $table->unsignedBigInteger('id_bill'); // Liên kết với bảng bills
            $table->unsignedBigInteger('id_product'); // Liên kết với bảng products
            $table->integer('quantity')->comment('số lượng');
            $table->double('unit_price');
            $table->timestamps(); // Tạo created_at & updated_at tự động

            // Thiết lập khóa ngoại (nếu cần)
            $table->foreign('id_bill')->references('id')->on('bills')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bill_detail');
    }
};
