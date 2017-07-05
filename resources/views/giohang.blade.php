@extends('layout')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Checkout</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Checkout</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form action="#" method="post" class="beta-form-checkout">
				<div class="row">
					<div class="col-sm-6">
						<h4>Billing Address</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="your_first_name">First name*</label>
							<input type="text" id="your_first_name" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">Last name*</label>
							<input type="text" id="your_last_name" required>
						</div>

						<div class="form-block">
							<label for="company">Company name</label>
							<input type="text" id="company">
						</div>

						<div class="form-block">
							<label for="adress">Address*</label>
							<input type="text" id="adress" value="Street Address" required>
							<input type="text" id="apartment" value="Apartment, suite, unit etc." required>
						</div>

						<div class="form-block">
							<label for="town_city">Town / City*</label>
							<input type="text" id="town_city" required value="Town / City*">
						</div>

						<div class="form-block">
							<label for="country/state">Country</label>
							<input type="text" id="country/state" value="State / Country">
						</div>

						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" id="email" required>
						</div>

						<div class="form-block">
							<label for="phone">Phone*</label>
							<input type="text" id="phone" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Order notes</label>
							<textarea id="notes"></textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
							<div class="your-order-body">
								<div class="your-order-item">
									<div>
									<!--  one item	 -->
									@foreach($product_cart as $product)
										<div class="media">
											<img width="35%" src="shopping/image/product/{{$product['item']->image}}" alt="" class="pull-left">
											<div class="media-body">
												<p class="font-large" style="margin-bottom: 20px; color: blue; font-size: 20px; ">{{$product['item']->name}}</p>
												
												<span class="">Số lượng: 
													<input class="btn btn-success btnGiam" type="button" value="-"  name="giam"  dataId ="{{$product['item']->id}}" soluong="{{$product['qty']}}" >
													<input type="text" name="soluong" value="{{$product['qty']}}" style="width: 35px" id="soluong-{{$product['item']->id}}">
													<input class="btn btn-success" type="button" value="+"  name="tang" class="btnTang">
												</span>
												<div>
												<span class=""><b>Đơn giá: 
													{{$product['qty']}}*{{$product['price']}}</b>
												</span>
												</div>
											</div>
										</div>
									@endforeach
									<!-- end one item -->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
									<div class="pull-right"><h5 class="color-black">{{number_format($totalPrice)}} đồng</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Payment Method</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Direct Bank Transfer </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text="">
										<label for="payment_method_cheque">Cheque Payment </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
										</div>						
									</li>
									
									<li class="payment_method_paypal">
										<input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal">
										<label for="payment_method_paypal">PayPal</label>
										<div class="payment_box payment_method_paypal" style="display: none;">
											Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account
										</div>						
									</li>
								</ul>
							</div>

							<div class="text-center"><a class="beta-btn primary" href="#">Checkout <i class="fa fa-chevron-right"></i></a></div>
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
<script src="shopping/assets/dest/js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$('.btnGiam').click(function(){
			var idSP = $(this).attr('dataId')
			var soluong = $(this).attr('soluong')
			$('#soluong-'+idSP).val(soluong-1)
		})
	})
</script>
@endsection