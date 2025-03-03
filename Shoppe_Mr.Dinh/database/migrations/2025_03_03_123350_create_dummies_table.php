<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dummies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->json('extras');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dummies');
    }
};
