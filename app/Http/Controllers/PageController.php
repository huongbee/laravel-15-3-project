<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
    	return view('trangchu');
    }

    public function getProductType(){
    	return view('loaisanpham');
    }

    public function getDetailProduct(){
    	return view('chitietsanpham');
    }

    public function getCart(){
    	return view('giohang');
    }

    public function getLogin(){
    	return view('login');
    }

    public function getRegister(){
    	return view('register');
    }
}
