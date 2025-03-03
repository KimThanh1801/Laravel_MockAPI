<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CreateTableController extends Controller
{
    public function createTable()
    {
        Schema::create('loaisanphams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->integer('price');
            $table->string('content');
            $table->string('active');
            $table->timestamps(); // Đã sửa lỗi chính tả

            echo "Bảng 'loaisanpham' đã được tạo thành công!";
        });
    }
}
