<div style="color: pink">
	Chào bạn {{$user->full_name}}, để kích hoạt tài khoản trên trang http://localhost/laravel15_3/public, vui lòng nhấp vào <a href="{{route('active_account',[$user->id,$user->email])}}">link</a> 
	<p>Thanks and Best Regards</p>
</div>