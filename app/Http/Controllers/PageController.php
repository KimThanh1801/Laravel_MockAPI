<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('page.trangchu');
    }
    public function getLoaiSp(){
        return view ('page.loai_sanpham');
    }
    public function getChitietSp(){
        return view ('page.chitiet_sanpham');
    } public function getLienheSp(){
        return view ('page.lienhe_sanpham');
    }
}
