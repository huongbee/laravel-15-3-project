@extends('layout')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">
					@if(!empty($user))
						Kích hoạt thành công
					@else
						Không tồn tại tài khoản này
					@endif
				</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>
					@if(!empty($user))
						Kích hoạt thành công
					@else
						Không tồn tại tài khoản này
					@endif</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			@if(!empty($user))
				<div>Cám ơn bạn đã đăng kí tài khoản, Tài khoản của bạn đã kích hoạt thành công</div>
			@else
				Không tồn tại tài khoản này
			@endif
			
			
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection