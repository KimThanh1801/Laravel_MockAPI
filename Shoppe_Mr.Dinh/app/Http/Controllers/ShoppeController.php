<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppeController extends Controller
{
    public function master(){
        return view ('page.homepage');
    }

    public function cart(){
        return view ('page.cart');
    }
    public function checkout(){
        return view ('page.checkout');
    }
    public function shop(){
        return view ('page.shop');
    }
    public function product_details(){
        return view ('page.product_details');
    }
    public function contact_us(){
        return view ('page.contact_us');
    }
    public function blog(){
        return view ('page.blog');
    }
    public function blog_singe(){
        return view ('page.blog_singe');
    }
    public function login(){
        return view ('page.login');
    }
}
