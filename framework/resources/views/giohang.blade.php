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
			
			<form action="{{route('dat-hang')}}" method="post" class="beta-form-checkout">
				<div class="row">
					<div class="col-sm-6">
						<h4>Thông tin đơn hàng</h4>
						<div class="space20">&nbsp;</div>


						<div class="form-block">
							<label for="your_last_name">Họ tên*</label>
							<input type="text" name="name" required>
						</div>
						<div class="form-block">
							<label for="your_last_name">Giới tính*</label>
							<input type="text" name="gender" required>
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" name="address" placeholder="90/92 Lê Thị Riêng, P.Bến Thành, Quận 1" required>
						</div>

						<div class="form-block">
							<label for="email">Email *</label>
							<input type="email" name="email" required>
						</div>

						<div class="form-block">
							<label for="phone">Điện thoại*</label>
							<input type="text" name="phone" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea name="notes"></textarea>
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
													<input class="btn btn-success btnTang" type="button" value="+"  name="tang" dataId ="{{$product['item']->id}}" soluong="{{$product['qty']}}">
												</span>
												<div>
												<span class=""><b>Đơn giá: 
													<span id="soluong{{$product['item']->id}}">{{$product['qty']}}</span>*<span id="dongia{{$product['item']->id}}">{{number_format($product['price']/$product['qty'])}}</span> đồng</b>
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
									<div class="pull-right"><h5 class="color-black"><span id="tongtien">{{number_format($totalPrice)}}</span> đồng</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">COD</label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Bạn gửi tiền vào tài khoản số :12345678, Hệ thống sẽ kiểm tra rồi ship hàng đến địa chỉ bạn cung cấp

										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="Tiền mặt" data-order_button_text="">
										<label for="payment_method_cheque">Thanh toán trực tiếp</label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Sau khi nhân viên giao hàng gửi hàng đến địa chỉ bạn cũng cấp, thì bạn gửi gửi tienf thanh toán lại cho nhân viên
										</div>						
									</li>
									
									<li class="payment_method_paypal">
										<input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="Giữ hàng tại của hàng" data-order_button_text="Proceed to PayPal">
										<label for="payment_method_paypal">Đặt giữ hàng tại của hàng</label>
										<div class="payment_box payment_method_paypal" style="display: none;">
											Hệ thống sẽ giữ đơn hàng của bạn có giá trị trong suốt 12 giờ sau khi bạn đặt hàng thành công. Sau 12 giờ, nếu bạn không đến nhận hàng thì đơn hàng bị hủy
										</div>						
									</li>
								</ul>
							</div>
							{{csrf_field()}}
							<div class="text-center"><button type="submit" class=" btn btn-success">Checkout <i class="fa fa-chevron-right"></i></button></div>
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
			if(soluong > 1){
				$('#soluong-'+idSP).val(soluong-1)
				$('#soluong'+idSP).html(soluong-1)

				var tongtien = $('#tongtien').html();
				tongtien = parseFloat(tongtien.replace(/\,/g,''))
				console.log(tongtien)
				var dongia = $('#dongia'+idSP).html();
				dongia = parseFloat(dongia.replace(',',''))

				$('#tongtien').html(tongtien - dongia)
				
				$.ajax({
					url:"{{route('reduce-incre-by-one')}}",
					type:"GET",
					data:{
						id:idSP,
						btn:'-'
					},
					success:function(data){
						console.log(data)
					},
					error:function(){
						console.log('Lỗi')
					}
				})
				$('.btnTang').attr('soluong',soluong-1)
			}
			$(this).attr('soluong',soluong-1) 
			
		})




		$('.btnTang').click(function(){
			var idSP = $(this).attr('dataId')
			console.log(idSP)
			var soluong = parseInt($(this).attr('soluong'))
			if(soluong < 10){
				$('#soluong-'+idSP).val(soluong+1)
				$('#soluong'+idSP).html(soluong+1)

				var tongtien = $('#tongtien').html();
				tongtien = parseFloat(tongtien.replace(/\,/g,''))
				var dongia = $('#dongia'+idSP).html();
				dongia = parseFloat(dongia.replace(',',''))

				$('#tongtien').html(tongtien + dongia)
				

				$.ajax({
					url:"{{route('reduce-incre-by-one')}}",
					type:"GET",
					data:{
						id:idSP,
						btn:'+'
					},
					success:function(data){
						console.log(data)
					},
					error:function(){
						console.log('Lỗi')
					}
				})
				$('.btnGiam').attr('soluong',soluong+1)
			}
			$(this).attr('soluong',soluong+1) 
			
		})
	})
</script>
@endsection