<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // Tự động tạo cột id với kiểu UNSIGNED INT
            $table->string('street')->nullable(); // VARCHAR(255) có thể NULL
            $table->string('country'); // VARCHAR(255) NOT NULL
            $table->unsignedInteger('icon_id')->nullable(); // INT(11) có thể NULL
            $table->unsignedInteger('monster_id'); // INT(11) NOT NULL
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
