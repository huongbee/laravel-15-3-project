<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use DB;
use App\TypeProduct;
use Session;
use App\Cart;

class PageController extends Controller
{
    public function getIndex(){
        //$loaisanpham = TypeProduct::all();
        $slide = Slide::all();
        $new_products = Product::orderBy('id','DESC')->limit(12)->get();
        $products_khuyenmai = Product::whereColumn('promotion_price','<','unit_price')->paginate(8); //8 sản phẩm trên trang
        //dd($products);
    	return view('trangchu',compact('slide','products_khuyenmai','new_products'));
    }

    public function getProductType($id){
        $products = Product::where('id_type',$id)->paginate(6);
        $type = TypeProduct::where('id',$id)->first();
    	return view('loaisanpham',compact('products','type'));
    }

    public function getDetailProduct($id){
        //$loaisanpham = TypeProduct::all();
        $product = Product::where('id',$id)->first();

        $type = $product->id_type;
        $related_products = Product::where('id_type',$type)->paginate(3);

    	return view('chitietsanpham',compact('product','related_products'));
    }

    public function getAddToCart(Request $req, $id){
        $product = Product::where('id',$id)->first();
        if($product){
            $oldCart = Session::has('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->add($product,$id,1);
            $req->session()->put('cart', $cart);
            $a = Session::get('cart');
            //dd($a);
            
            return redirect()->back()->with('succsess','Thêm thành công');
        }
        else{
            return redirect()->back()->with('error','Không tìm thấy sản phẩm');
        }

    }
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart',$cart);
        return redirect()->back()->with('succsess','Xóa thành công');
    }



    public function getCart(){
        if(Session::has('cart')){
            return view('giohang');
        }
        else{
            return redirect()->route('trangchu');
        }
    	
    }

    public function getLogin(){
    	return view('login');
    }

    public function getRegister(){
    	return view('register');
    }
}
