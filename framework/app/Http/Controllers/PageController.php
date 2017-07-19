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
use Mail;
use Auth;
use Socialite;
use App\SocialProvider;

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

        Mail::send('noidung_guimail', ['user' => $user], function ($message) use ($req)
        {
            $message->from('huonghuong08.php@gmail.com', 'Username');
            $message->to($req->email,$req->fullname);
            $message->subject('Kích hoạt tài khoản');
        });


        return redirect()->back()->with('thanhcong','Đăng kí thành công');
    }



    public function getActiveAccount($id,$email){
        $user = User::where('id',$id)->first();
        if($user){
            $user->active = 1;
            $user->save();
            return view('active_acc',compact('user'));
        }
        else{

            return view('active_acc',compact('user'));
        }
        
    }


    public function getLogin(){
    	return view('login');
    }

    public function postLogin(Request $req){
        $this->validate($req,
            [
                "email"=>"required|email",
                'password'=>'required|min:6|max:30'
            ],
            [
                'email.required'=>'VUi lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'password.required'=>"Vui lòng nhập mật khẩu",
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu không quá 30 kí tự'
            ]
        );
        $arr = array(
                    'email'=>$req->email,
                    'password'=>$req->password
                );

        if(Auth::attempt($arr)){
            return redirect()->route('trangchu');
        }
        else{
            return redirect()->back()->with('thatbai','Đăng nhập không thành công');
        }
    }


    public function getLogout(){
        Auth::logout();
        return redirect()->back();
    }


    public function getSearch(Request $req){
        $products = Product::where('name','like',"%$req->keyword%")
                        ->orWhere('unit_price','=',$req->keyword)
                        ->orWhere('promotion_price','=',$req->keyword)
                        ->get();
        return view('search',compact('products'));
    }



    public function redirectToProvider($providers){
        return Socialite::driver($providers)->redirect();
    }




    public function handleProviderCallback($providers){
        try{
            $socialUser = Socialite::driver($providers)->user();
            //return $user->getEmail();
        }
        catch(\Exception $e){
            //dd($e->getResponse()->getBody()->getContents());
            return redirect()->route('login')->with(['flash_level'=>'danger','flash_message'=>"Đăng nhập không thành công"]);
        }

        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())
                                        ->first();
        if(!$socialProvider){
            //tạo mới
            $user = User::where('email',$socialUser->getEmail())->first();
            if($user){
              return redirect()->route('login')->with(['flash_level'=>'danger','flash_message'=>"Email đã có người sử dụng"]);
            }
            else{
              $user = new User();
              $user->email = $socialUser->getEmail();
              $user->full_name = $socialUser->getName();
              if($providers == 'google'){
                $image = explode('?',$socialUser->getAvatar());
                $user->avatar = $image[0];
              }
              $user->avatar = $socialUser->getAvatar();
              $user->save();
            }
            $provider = new SocialProvider();
            $provider->provider_id = $socialUser->getId();
            $provider->provider = $providers;
            $provider->email = $socialUser->getEmail();
            $provider->save();
        }
        else{
            $user = User::where('email',$socialUser->getEmail())->first();
        }
        Auth()->login($user);
        return redirect()->route('trangchu')->with(['flash_level'=>'success','flash_message'=>"Đăng nhập thành công"]);
    }

    
}
