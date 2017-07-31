<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\TypeProduct;
use Auth;
use App\User;

class AdminController extends Controller
{
    public function getIndex(){
    	/*if(!Auth::check()){
    		return redirect()->route('login');
    	}*/
    	$products = Product::with('Images')->orderBy('id','DESC')->paginate(10);
    	//dd($products);
    	return view('admin.index',compact('products'));
    }


    public function getAddProduct(){

    	$type = TypeProduct::all();
    	return view('admin.add_product',compact('type'));
    }


    public function postAddProduct(Request $req){
    	$this->validate($req,
    		[
	    		'name'=>'required',
	    		'loai'=>'required',
	    		'price'=>'required|numeric',
	    		'promotion'=>'required|numeric',
	    		'unit'=>'required',
	    		'hinh'=>'image',
	    	],
	    	[
	    		'name.required'=>'Vui lòng nhập tên sản phẩm',
	    		'loai.required'=>'Vui chọn 1 loại',
	    		'price.required'=>'Vui lòng nhập giá',
	    		'price.numeric'=>'Giá sản phẩm phải là số',

	    	]
	    );
	    if($req->hasFile('hinh')){
	    	$image = $req->file('hinh');
	    	if($image->getClientSize()<2*1024*1024){
	    		$base_name = $image->getClientOriginalName(); //a.png

	    		$name = pathinfo($base_name,PATHINFO_FILENAME).time(); //a12345677654

	    		$ext = $image->getClientOriginalExtension();
	    		$final_name = $name.'.'.$ext;
	    		$image->move('shopping/image/product',$final_name);
	    		//luw thông tin xuống db
	    		$product = new Product;
	    		//sửa $product = Product::where()->first()
	    		$product->name = $req->name;
	    		$product->id_type = $req->loai;
	    		$product->unit_price = $req->price;
	    		$product->promotion_price = $req->promotion;
	    		$product->unit = $req->unit;
	    		
	    		if($req->spmoi == 1 || $req->spmoi == 'on'){
	    			$product->new = 1;
	    		}
	    		else{
	    			$product->new = 0;
	    		}
	    		$product->image = $final_name;
	    		$product->description = $req->description;
	    		$product->save();
	    		return redirect()->route('admin.trangchu');
	    	}
	    	else{
	    		return redirect()->back()->with('err_file','File quá lớn');
	    	}
	    }
	    else{
	    	return redirect()->back()->withInput()->with('err_file','Vui lòng chọn hình');
	    }

    }

    public function getEditProduct($id){
    	$type = TypeProduct::all();
    	$product = Product::where('id',$id)->first();
    	return view('admin.edit_product',compact('type','product'));
    }


    public function postEditProduct($id, Request $req){
    	$product = Product::where('id',$id)->first();
    	if($product){
    		$this->validate($req,
	    		[
		    		'name'=>'required',
		    		'loai'=>'required',
		    		'price'=>'required|numeric',
		    		'promotion'=>'required|numeric',
		    		'unit'=>'required',
		    		'hinh'=>'image',
		    	],
		    	[
		    		'name.required'=>'Vui lòng nhập tên sản phẩm',
		    		'loai.required'=>'Vui chọn 1 loại',
		    		'price.required'=>'Vui lòng nhập giá',
		    		'price.numeric'=>'Giá sản phẩm phải là số',

		    	]
		    );
		    if($req->hasFile('hinh')){
		    	$image = $req->file('hinh');
		    	if($image->getClientSize()<2*1024*1024){
		    		$base_name = $image->getClientOriginalName(); //a.png

		    		$name = pathinfo($base_name,PATHINFO_FILENAME).time(); //a12345677654

		    		$ext = $image->getClientOriginalExtension();
		    		$final_name = $name.'.'.$ext;
		    		$image->move('shopping/image/product',$final_name);
		    		
		    		$product->image = $final_name;
		    		$product->save();
		    		
		    	}
		    	else{
		    		return redirect()->back()->with('err_file','File quá lớn');
		    	}
		    }
		    $product->name = $req->name;
    		$product->id_type = $req->loai;
    		$product->unit_price = $req->price;
    		$product->promotion_price = $req->promotion;
    		$product->unit = $req->unit;
    		
    		if($req->spmoi == 1 || $req->spmoi == 'on'){
    			$product->new = 1;
    		}
    		else{
    			$product->new = 0;
    		}
    		$product->description = $req->description;
    		$product->save();
    		return redirect()->route('admin.trangchu');

    	}
    	else{
    		return redirect()->route('admin.trangchu')->with('error','không tồn tại sp này');
    	}
    }

    public function getDeleteProduct($id){
    	$product = Product::where('id',$id)->first();
    	if($product){
    		$product->delete();
    		return redirect()->back()->with('success','Xóa thành công');
    	}
    	else{
    		return redirect()->back()->with('error','không tồn tại sp này');
    	}
    }

    public function getListTypeProduct(){
    	$types = TypeProduct::paginate(10);
    	return view('admin.list_type_product',compact('types'));
    }

    public function getAddTypeProduct(){
    	return view('admin.add_type');
    }

    public function postAddTypeProduct(Request $req){
    	
    	$type = new TypeProduct;
		$this->validate($req,
    		[
	    		'name'=>'required',
	    		'hinh'=>'image',
	    	],
	    	[
	    		'name.required'=>'Vui lòng nhập tên sản phẩm',
	    		'hinh.image'=>'Vui lòng chọn file là hình ảnh',
	    	]
	    );
	    if($req->hasFile('hinh')){
	    	$image = $req->file('hinh');
	    	if($image->getClientSize()<2*1024*1024){
	    		$base_name = $image->getClientOriginalName(); //a.png

	    		$name = pathinfo($base_name,PATHINFO_FILENAME).time(); //a12345677654

	    		$ext = $image->getClientOriginalExtension();
	    		$final_name = $name.'.'.$ext;
	    		$image->move('shopping/image/product',$final_name);
	    		
	    		$type->image = $final_name;
	    		$type->name = $req->name;
				$type->description = $req->description;
				$type->save();
	    		
	    	}
	    	else{
	    		return redirect()->back()->with('err_file','File quá lớn');
	    	}
	    }
	    
		return redirect()->route('admin.type-product');
    }

    public function getEditTypeProduct(Request $req){
    	$type = TypeProduct::where('id',$req->id)->first();
    	return view('admin.edit_type',compact('type'));
    }

    public function postEditTypeProduct(Request $req, $id){
    	$type = TypeProduct::where('id',$id)->first();
    	if($type){
    		$this->validate($req,
	    		[
		    		'name'=>'required',
		    		'hinh'=>'image',
		    	],
		    	[
		    		'name.required'=>'Vui lòng nhập tên sản phẩm',
		    		'hinh.image'=>'VUi lòng chọn file hình'

		    	]
		    );
		    if($req->hasFile('hinh')){
		    	$image = $req->file('hinh');
		    	if($image->getClientSize()<2*1024*1024){
		    		$base_name = $image->getClientOriginalName(); //a.png

		    		$name = pathinfo($base_name,PATHINFO_FILENAME).time(); //a12345677654

		    		$ext = $image->getClientOriginalExtension();
		    		$final_name = $name.'.'.$ext;
		    		$image->move('shopping/image/product',$final_name);
		    		
		    		$type->image = $final_name;
		    		$type->save();
		    		
		    	}
		    	else{
		    		return redirect()->back()->with('err_file','File quá lớn');
		    	}
		    }
		    $type->name = $req->name;
    		$type->description = $req->description;
    		$type->save();
    		return redirect()->route('admin.type-product');

    	}
    	else{
    		return redirect()->route('admin.type-product')->with('error','không tồn tại loại sp này');
    	}
    }

    public function getDeleteTypeProduct($id){
    	$type = TypeProduct::where('id',$id)->first();
    	if($type){
    		$product = Product::where('id_type',$id)->get(); //lấy sp có chứa id_loai
    		if(count($product)>0){//nếu có sp ->có khóa ngoại ->ko xóa được
    			return redirect()->route('admin.type-product')->with('error','Không thể xóa loại sp. Vì đã có SP');
    		}
    		else{
    			//nếu ko có sp
	    		$type->delete();
	    		return redirect()->route('admin.type-product')->with('success','Xóa thành công');
    		}
    		
    	}
    	else{
    		return redirect()->route('admin.type-product')->with('error','không tồn tại loại sp này');
    	}
    }

    public function getListUser(){
    	$user = User::orderBy('admin','DESC')->paginate(10);
    	return view('admin.list_user',compact('user'));
    }

    public function getEditUser(Request $req){
    	$id_user = $req->user;
    	$user = User::where('id',$id_user)->first();
    	if($user){
    		$user->admin = 1;
    		$user->save();

    	}
    }
    public function getDeleteUser($id){
    	$user = User::where('id',$id)->first();
    	if($user){
    		
    		$user->delete();
    		return redirect()->back()->with('success','Xóa thành công');

    	}
    	return redirect()->back()->with('success','Lỗi');

    }
}

