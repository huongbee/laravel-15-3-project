<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\TypeProduct;

class AdminController extends Controller
{
    public function getIndex(){
    	$products = Product::with('Images')->orderBy('id','DESC')->paginate(10);
    	//dd($products);
    	return view('admin.index',compact('products'));
    }


    public function getAddProduct(){

    	$type = TypeProduct::all();
    	return view('admin.add_product',compact('type'));
    }
}

