<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('id_type');
            $table->text('description')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->decimal('promotion_price', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('id_type')->references('id')->on('type_products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
