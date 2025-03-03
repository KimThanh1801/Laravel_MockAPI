<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Tự động tạo id (UNSIGNED INT)
            $table->unsignedInteger('parent_id')->default(0); // INT(11) DEFAULT 0
            $table->unsignedInteger('lft')->nullable(); // INT(10) UNSIGNED DEFAULT NULL
            $table->unsignedInteger('rgt')->nullable(); // INT(10) UNSIGNED DEFAULT NULL
            $table->unsignedInteger('depth')->nullable(); // INT(10) UNSIGNED DEFAULT NULL
            $table->string('name'); // VARCHAR(255) NOT NULL
            $table->string('slug'); // VARCHAR(255) NOT NULL
            $table->timestamps(); // created_at và updated_at (có thể NULL)
            $table->softDeletes(); // deleted_at (hỗ trợ xóa mềm)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
