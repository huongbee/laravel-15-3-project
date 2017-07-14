<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use DB;
use App\TypeProduct;
use Session;
use App\Cart;
use App\Customer;
use App\Bills;
use App\BillDetail;
use App\User;
use Hash;

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

    public function getReduceIncreByOne(Request $req){
        $id = $req->id;
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        if($req->btn=='-'){
            $cart->reduceByOne($id);
        }
        elseif($req->btn=='+'){
            $cart->increByOne($id);
        }
        
        Session::put('cart',$cart); 
    
    }




    public function getCart(){
        if(Session::has('cart')){
            return view('giohang');
        }
        else{
            return redirect()->route('trangchu');
        }
    	
    }


    public function postCheckout(Request $req){
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();
        if($customer){
            $bill = new Bills;
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');

            $cart = Session::get('cart');
            $total = $cart->totalPrice;

            $bill->total = $total;
            $bill->payment = $req->payment_method;
            $bill->save();
            if($bill){
                foreach($cart->items as $key => $item){
                    $bill_detail = new BillDetail;
                    $bill_detail->id_bill = $bill->id;
                    $bill_detail->id_product = $item['item']->id;
                    $bill_detail->quantity = $item['qty'];
                    $bill_detail->unit_price = $item['price']/$item['qty'];
                    $bill_detail->save();
                }
                
                Session::forget('cart');
                return redirect()->route('trangchu')->with('thanhcong','Đặt hàng thành công');
            }

        }
    }


    public function getRegister(){
        return view('register');
    }

    public function postRegister(Request $req){
        $this->validate($req,
            [
                'email'=>'required|unique:users|email|min:10|max:100',
                'fullname'=>'required|min:10|max:100',
                'password'=>'required|min:6|max:20',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.unique'=>'Email đã được sử dụng',
                'email.min'=>'Email ít nhất 10 kí tự',
                'email.max'=>'Email không quá 100 kí tự',
                'fullname.required'=>'Vui lòng nhập tên',
                're_password.same' =>'Mật khẩu không giống nhau'
            ]
        );
        $user = new User;
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->remember_token = csrf_token();
        $user->save();
        
        return redirect()->back()->with('thanhcong','Đăng kí thành công');
    }


    public function getLogin(){
    	return view('login');
    }

    
}
