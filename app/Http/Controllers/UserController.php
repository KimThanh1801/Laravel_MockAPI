<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getLogin(){
        return view ('user.login');
    }

    public function singup(){
        return view ('user.singup');
    }
}
