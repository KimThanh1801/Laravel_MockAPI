<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('browse')->nullable();
            $table->boolean('checkbox')->nullable();
            $table->text('wysiwyg')->nullable();
            $table->string('color')->nullable();
            $table->string('color_picker')->nullable();
            $table->date('date')->nullable();
            $table->date('date_picker')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->datetime('datetime')->nullable();
            $table->datetime('datetime_picker')->nullable();
            $table->string('email')->nullable();
            $table->integer('hidden')->nullable();
            $table->string('icon_picker')->nullable();
            $table->string('image')->nullable();
            $table->string('month')->nullable();
            $table->integer('number')->nullable();
            $table->double('float', 8, 2)->nullable();
            $table->string('password')->nullable();
            $table->string('radio')->nullable();
            $table->string('range')->nullable();
            $table->integer('select')->nullable();
            $table->string('select_from_array')->nullable();
            $table->integer('select2')->nullable();
            $table->string('select2_from_ajax')->nullable();
            $table->string('select2_from_array')->nullable();
            $table->text('simplemde')->nullable();
            $table->text('summernote')->nullable();
            $table->text('table')->nullable();
            $table->text('textarea')->nullable();
            $table->string('text');
            $table->text('tinymce')->nullable();
            $table->string('upload')->nullable();
            $table->string('upload_multiple')->nullable();
            $table->string('url')->nullable();
            $table->text('video')->nullable();
            $table->string('week')->nullable();
            $table->text('extras')->nullable();
            $table->timestamps();
            $table->binary('base64_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monsters');
    }
};
