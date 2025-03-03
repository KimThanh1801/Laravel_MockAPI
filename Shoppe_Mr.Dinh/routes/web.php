<?php

use App\Http\Controllers\CreateTableController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\DatabaseSetupController;
use App\Http\Controllers\ShoppeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master',[ShoppeController::class,'master']);
Route::get('/cart',[ShoppeController::class,'cart']);
Route::get('/checkout',[ShoppeController::class,'checkout']);
Route::get('/shop',[ShoppeController::class,'shop']);
Route::get('/product_details',[ShoppeController::class,'product_details']);
Route::get('/contact_us',[ShoppeController::class,'contact_us']);
Route::get('/blog',[ShoppeController::class,'blog']);
Route::get('/blog_singe',[ShoppeController::class,'blog_singe']);
Route::get('/login',[ShoppeController::class,'login']);
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::get('/laravel_db', [DatabaseController::class, 'createTables']);


// // Route::get('/database', function(){
// //     Schema::create('loaisanpham',function($table) {
// //         $table->increments('id');
// //         $table->string('name',200);
// //         $table->integer('price');
// //         $table->string('image',200);
// //     });
// //     echo "ban da thanh cong";
// // });
// Route::get('/database', [CreateTableController::class, 'createTable']);


// TẠO ROUTE CHO DATABASECONTROLLER