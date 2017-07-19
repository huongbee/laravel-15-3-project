@extends('layout')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form action="{{route('login')}}" method="post" class="beta-form-checkout">
				{{csrf_field()}}
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>

						@if(Session::has('thatbai'))
						<div class="alert alert-danger">
							{{Session::get('thatbai')}}
						</div>
						@endif

						@if(count($errors)>0)
						<div class="alert alert-danger">

							@foreach($errors->all() as $err)
								<li>{{$err}}</li>
							@endforeach
						</div>
						@endif
						
						<div class="space20">&nbsp;</div>
						
						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" name="email" required>
						</div>
						<div class="form-block">
							<label for="password">Password*</label>
							<input type="password" name="password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<a href="{{route('provider_login','facebook')}}">
					<button class="btn btn-primary">Đăng nhập bằng Facebook</button>
				</a>
				<a href="{{route('provider_login','google')}}">
					<button class="btn btn-success">Đăng nhập bằng Google</button>
				</a>
			</div>
			<div class="col-sm-3"></div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection