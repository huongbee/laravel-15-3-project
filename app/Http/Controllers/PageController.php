<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use DB;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        $new_products = Product::orderBy('id','DESC')->limit(12)->get();
        $products_khuyenmai = Product::whereColumn('promotion_price','<','unit_price')->paginate(8); //8 sản phẩm trên trang
        //dd($products);
    	return view('trangchu',compact('slide','products_khuyenmai','new_products'));
    }

    public function getProductType(){
    	return view('loaisanpham');
    }

    public function getDetailProduct($id){
        $product = Product::where('id',$id)->first();

        $type = $product->id_type;
        $related_products = Product::where('id_type',$type)->paginate(3);

    	return view('chitietsanpham',compact('product','related_products'));
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
