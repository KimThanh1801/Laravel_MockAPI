<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_customer')->nullable();
            $table->date('date_order')->nullable();
            $table->float('total')->nullable()->comment('tổng tiền');
            $table->string('payment', 200)->nullable()->comment('hình thức thanh toán');
            $table->string('note', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
