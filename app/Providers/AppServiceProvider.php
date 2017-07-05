<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
use View;
use Session;
use App\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $loaisanpham = TypeProduct::all();
        View::share('loaisanpham',$loaisanpham);


        View::composer(['layout','giohang'], function ($view) {
            if(Session::has('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                //dd($cart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
