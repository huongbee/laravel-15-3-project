@extends('admin.layout')
@section('content')
  <section id="main-content">
      <section class="wrapper">
        <div class="panel panel-body">
          <section class="content">
              <div class="panel panel-default">
                  <div class="panel-heading"><b>Sửa thông tin sản phẩm {{$product->name}}</b>
                  </div>
                  <div class="panel-body">

                    @if(count($errors)>0)
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div>
                    @endif
                    @if(Session::has('err_file'))
                      <div class="alert alert-danger">
                        {{Session::get('err_file')}}
                      </div>
                    @endif
                     <form method="POST" enctype="multipart/form-data" action="{{route('admin.edit_product',$product->id)}}">
                      {{csrf_field()}}
                      <div class="col-md-6">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="{{$product->name}}">
                      </div>
                      <div class="col-md-6">
                        <label>Chọn loại</label>
                          <select name="loai" class="form-control">
                            @foreach($type as $loai)
                              <option value="{{$loai->id}}" @if($product->id_type==$loai->id) selected @endif>{{$loai->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-md-6">
                        <label>Giá sản phẩm</label>
                        <input type="text" name="price" class="form-control" value="{{$product->unit_price}}">
                      </div>
                      <div class="col-md-6">
                        <label>Giá Khuyến mãi</label>
                        <input type="text" name="promotion" class="form-control" value="{{$product->promotion_price}}">
                      </div>
                      <div class="col-md-6">
                        <label>Đơn vị tính</label>
                        <input type="text" name="unit" class="form-control" value="{{$product->unit}}">
                      </div>
                      
                      <div class="col-md-12" style="padding: 10px 20px">
                        <label>
                          <input type="checkbox" name="spmoi" @if($product->new==1) checked @endif > Sản phẩm mới
                        </label>
                      </div>
                      <div class="col-md-9">
                        <label>
                          <input type="file" name="hinh">
                        </label>
                      </div>
                      <div class="col-md-12"  style="padding: 10px 20px">
                        <label>Mô tả
                          <textarea class="form-control col-md-12" name="description" rows="5" id="content">
                            {{$product->description}}
                          </textarea>
                          <script>
                            CKEDITOR.replace('content')
                          </script>
                        </label>
                      </div>
                      <div class="col-md-12">
                      <button class=" btn btn-success" name="luu">Thêm mới</button>
                      </div>
                     </form>
                  </div>
              </div>
          </section>
        </div>
      </section>
  </section>
@endsection