<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slide;
use App\Models\TypeProduct;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $slide = Slide::all();
        $new_product = Product::where('new', 1)->paginate(8);
        $promotion_product = Product::where('promotion_price', '>', 0)->paginate(8);

        return view('page.trangchu', compact('slide', 'new_product', 'promotion_product'));
    }

    // public function getLoaiSp()
    // {
    //     return view('page.loai_sanpham');
    // }
    public function getChitietSp()
    {
        return view('page.chitiet_sanpham');
    }
    public function getLienheSp()
    {
        return view('page.lienhe_sanpham');
    }
    public function themgiohang()
    {
        return view('page.themgiohang');
    }
    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->get();
        $type_product = TypeProduct::all();
        $sp_khac = Product::where('id_type', '<>', $type)->paginate(3);

        return view('page.loai_sanpham', compact('sp_theoloai', 'type_product', 'sp_khac'));
    }
    public function chitietsanpham($id) {
        $product_detail = Product::findOrFail($id);
        return view('page.chitiet_sanpham', compact('product_detail'));
    }
    
}


