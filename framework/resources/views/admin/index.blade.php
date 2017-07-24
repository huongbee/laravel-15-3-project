@extends('admin.layout')
@section('content')
  <section id="main-content">
      <section class="wrapper">
        <div class="panel panel-body">
          <section class="content">
              <div class="panel panel-default">
                  <div class="panel-heading"><b>Danh sách sản phẩm</b>
                  </div>
                  <div class="panel-body">
                  @if(Session::has('error'))
                    <div class="alert alert-danger">
                      {{Session::get('error')}}
                    </div>
                  @endif
                  @if(Session::has('success'))
                    <div class="alert alert-success">
                      {{Session::get('success')}}
                    </div>
                  @endif
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Tên</th>
                            <th>Loại</th>
                            <th>Đơn giá</th>
                            <th>Khuyến mãi</th>
                            <th>Hình</th>
                            <th>Sản phẩm mới</th>
                            <th>Sửa | Xóa</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $p)
                          <tr>
                            <td>{{$p->name}}</td>
                            <td>{{$p->TypeProduct->name}}</td>
                            <td>{{number_format($p->unit_price)}}</td>
                            <td>{{number_format($p->promotion_price)}}</td>
                            <td>
                                <img src="shopping/image/product/{{$p->image}}" style="width: 100px">
                                {{-- @foreach($p->Images as $hinh)
                                <img src="shopping/image/product/{{$hinh->image}}" style="width: 100px">
                                @endforeach --}}
                            </td>
                            <td><input type="checkbox" @if($p->new==1) checked @endif ></td>
                            <td>
                              <a href="{{route('admin.edit_product',$p->id)}}">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
                              </a> | 
                              <a href="{{route('admin.delete_product',$p->id)}}">
                                <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                              </a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>

                      </table>
                      {{$products->links()}}
                  </div>
              </div>
          </section>
        </div>
      </section>
  </section>
@endsection