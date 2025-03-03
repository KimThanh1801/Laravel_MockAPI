<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('postalboxes', function (Blueprint $table) {
            $table->id();
            $table->string('postal_name')->nullable();
            $table->unsignedBigInteger('monster_id');
            $table->foreign('monster_id')->references('id')->on('monsters')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postalboxes');
    }
};
