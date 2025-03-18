<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Route;

// Route::controller(ProductController::class)
//     ->name('products.')
//     ->prefix('products')
//     ->group(function () {
//         // Danh sách sản phẩm
//         Route::get('/', 'index')->name('index');
//         // Hiển thị form thêm sản phẩm
//         Route::get('/create', 'create')->name('create');
//         // Xử lý lưu sản phẩm mới
//         Route::post('/store', 'store')->name('store');
//         // Hiển thị form chỉnh sửa sản phẩm
//         Route::get('/{id}/edit', 'edit')->name('edit');
//         // Cập nhật sản phẩm
//         Route::put('/{id}', 'update')->name('update');
//         // Xóa sản phẩm
//         Route::delete('/{id}', 'destroy')->name('destroy');
//     });

Route::get('/',function(){
    return view ('/welcome');
});

Route::get('/productss', [ShowController::class, 'index'])->name('productss.index');
Route::get('index', [PageController::class, 'index'])->name('trang-chu');
Route::get('/loai-san-pham/{type}', [PageController::class, 'getLoaiSp'])->name('loai_sanpham');
// Route::get('chitiet_sanpham', [PageController::class, 'getChitietSp'])->name('chitiet_sanpham');
Route::get('lienhe_sanpham', [PageController::class, 'getLienheSp'])->name('lienhe_sanpham');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/', [PageController::class, 'index']);
Route::get('themgiohang', [PageController::class, 'themgiohang'])->name('themgiohang');
Route::get('/chitiet_sanpham/{id}', [PageController::class, 'chitietsanpham'])->name('chitiet_sanpham');
Route::get('/detail/{id}',[PageController::class, 'getDetail'])->name('chitiet_sanpham');
Route::post('/comment/{id}', [PageController::class, 'getDetail'])->name('comment.store');

// Route::prefix('admin')->group(function () {
//     Route::get('/', [AdminController::class, 'admin'])->name('admin.dashboard');
//     Route::get('/edit/{id}', [AdminController::class, 'getAdminEdit'])->name('admin.edit');
//     Route::post('/delete/{id}', [AdminController::class, 'postAdinDelete'])->name('admin.delete');
// });

Route::get('/admin',[PageController::class,'getIndexAdmin']);
Route::get('/admin/edit/{id}', [PageController::class, 'getAdminEdit'])->name('getadminedit');
// Route::post('/admin/add-product', [PageController::class, 'postAdminAdd'])->name('add-product');


Route::get('/admin-edit-form/{id}', [PageController::class, 'getAdminEdit']);
Route::post('/admin-edit', [PageController::class, 'postAdminEdit']);

// Route::get('/admin-add-form',[PageController::class,'postAdminAdd']);
Route::post('/admin/delete/{id}', [AdminController::class, 'postAdminDelete'])->name('admindelete');

Route::get('/export', [ExportController::class, 'export'])->name('export');

Route::get('/admin/add-product', [PageController::class, 'showAddProductForm'])->name('add-product.form');
Route::post('/admin/add-product', [PageController::class, 'postAdminAdd'])->name('add-product');