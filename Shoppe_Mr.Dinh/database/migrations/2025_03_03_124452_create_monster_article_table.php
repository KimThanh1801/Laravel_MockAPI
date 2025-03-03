<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monster_article', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monster_id');
            $table->unsignedBigInteger('article_id');
            $table->timestamps();
            $table->softDeletes();

            // Khóa ngoại (nếu có bảng `monsters` và `articles`)
            $table->foreign('monster_id')->references('id')->on('monsters')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monster_article');
    }
};
