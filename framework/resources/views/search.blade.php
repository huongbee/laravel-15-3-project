<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
						<h4>Tìm thấy <strong>{{count($products)}}</strong> sản phẩm phù hợp</h4>
						

						<div class="row">
							@foreach($products as $new)
							<div class="col-sm-3" style="margin-bottom: 30px">
								<div class="single-item">
									<div class="single-item-header">
										<a href="{{route('chi-tiet-san-pham',$new->id)}}"><img src="shopping/image/product/{{$new->image}}" alt="" height="250"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$new->name}}</p>
										<p class="single-item-price">
										@if($new->unit_price>$new->promotion_price)
											<span class="flash-del">{{number_format($new->unit_price)}} đồng</span>
											<span class="flash-sale">{{number_format($new->promotion_price)}} đồng</span>
										@else
											<span class="flash-sale">{{number_format($new->unit_price)}} đồng</span>
										@endif

										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('gio-hang',$new->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('chi-tiet-san-pham',$new->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div> <!-- .beta-products-list -->

					
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->