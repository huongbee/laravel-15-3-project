@extends('layout')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$type->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="./">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
						@foreach($loaisanpham as $loai)
						<li><a href="{{route('loai-san-pham',$loai->id)}}">{{$loai->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4>Danh sách sản phẩm </h4>
						<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{count($products)}} sản phẩm</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach($products as $p)
							<div class="col-sm-4" style="margin-bottom: 30px">
								<div class="single-item">
										<div class="single-item-header">
											<a href="{{route('chi-tiet-san-pham',$p->id)}}"><img src="shopping/image/product/{{$p->image}}" alt="" height="250"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$p->name}}</p>
											<p class="single-item-price">
											@if($p->unit_price>$p->promotion_price)
												<span class="flash-del">{{number_format($p->unit_price)}} đồng</span>
												<span class="flash-sale">{{number_format($p->promotion_price)}} đồng</span>
											@else
												<span class="flash-sale">{{number_format($p->unit_price)}} đồng</span>
											@endif

											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chi-tiet-san-pham',$p->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
							</div>
							@endforeach
						</div>
						<div class="row">{{$products->links()}}</div>
					</div> <!-- .beta-products-list -->

				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection