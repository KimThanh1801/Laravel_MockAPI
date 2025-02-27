<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)
    ->name('products.')
    ->prefix('products')
    ->group(function () {
        // Danh sách sản phẩm
        Route::get('/', 'index')->name('index');
        // Hiển thị form thêm sản phẩm
        Route::get('/create', 'create')->name('create');
        // Xử lý lưu sản phẩm mới
        Route::post('/store', 'store')->name('store');
        // Hiển thị form chỉnh sửa sản phẩm
        Route::get('/{id}/edit', 'edit')->name('edit');
        // Cập nhật sản phẩm
        Route::put('/{id}', 'update')->name('update');
        // Xóa sản phẩm
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::get('/productss', [ShowController::class, 'index'])->name('productss.index');

Route::get('index', [PageController::class, 'index'])->name('trang-chu');
Route::get('loai_sanpham', [PageController::class, 'getLoaiSp'])->name('loai_sanpham');
Route::get('chitiet_sanpham', [PageController::class, 'getChitietSp'])->name('chitiet_sanpham');
Route::get('lienhe_sanpham', [PageController::class, 'getLienheSp'])->name('lienhe_sanpham');
Route::get('about', [PageController::class, 'about'])->name('about');