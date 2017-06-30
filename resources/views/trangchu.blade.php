@extends('layout')
@section('content')
<div class="rev-slider">
	<div class="fullwidthbanner-container">
		<div class="fullwidthbanner">
			<div class="bannercontainer" >
			    <div class="banner" >
					<ul>
							<!-- THE FIRST SLIDE -->
						@foreach($slide as $sl)
						<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
				            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
								<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="shopping/image/slide/{{$sl->image}}" data-src="shopping/image/slide/{{$sl->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('shopping/image/slide/{{$sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
								</div>
							</div>

				        </li>
				        @endforeach
					</ul>
				</div>
			</div>

			<div class="tp-bannertimer"></div>
		</div>
	</div>
				<!--slider-->
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Sản phẩm mới</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($new_products)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($new_products as $new)
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
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chi-tiet-san-pham',$new->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản phẩm khuyến mãi</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($products_khuyenmai)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($products_khuyenmai as $khuyenmai)
								<div class="col-sm-3" style="margin-bottom: 30px">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{route('chi-tiet-san-pham',$khuyenmai->id)}}"><img src="shopping/image/product/{{$khuyenmai->image}}" alt="" height="250"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$khuyenmai->name}}</p>
											<p class="single-item-price">
											@if($khuyenmai->unit_price>$khuyenmai->promotion_price)
												<span class="flash-del">{{number_format($khuyenmai->unit_price)}} đồng</span>
												<span class="flash-sale">{{number_format($khuyenmai->promotion_price)}} đồng</span>
											@else
												<span class="flash-sale">{{number_format($khuyenmai->unit_price)}} đồng</span>
											@endif

											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chi-tiet-san-pham',$khuyenmai->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="row">
							{{$products_khuyenmai->links()}}
							</div>	
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection