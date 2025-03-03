<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('b_s', function (Blueprint $table) {
            $table->id(); // Tự động tạo id (UNSIGNED INT)
            $table->string('data'); // VARCHAR(255) NOT NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('b_s');
    }
};
