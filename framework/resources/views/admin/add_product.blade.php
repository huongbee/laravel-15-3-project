@extends('admin.layout')
@section('content')
  <section id="main-content">
      <section class="wrapper">
        <div class="panel panel-body">
          <section class="content">
              <div class="panel panel-default">
                  <div class="panel-heading"><b>Thêm sản phẩm mới</b>
                  </div>
                  <div class="panel-body">
                     <form method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="col-md-6">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Chọn loại</label>
                          <select name="loai" class="form-control">
                            @foreach($type as $loai)
                              <option value="{{$loai->id}}">{{$loai->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-md-6">
                        <label>Giá sản phẩm</label>
                        <input type="text" name="price" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Giá Khuyến mãi</label>
                        <input type="text" name="promotion" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Đơn vị tính</label>
                        <input type="text" name="unit" class="form-control">
                      </div>
                      <div class="col-md-12" style="padding: 10px 20px">
                        <label>
                          <input type="checkbox" name="noibat"> Nổi bật
                        </label>
                      </div>
                      <div class="col-md-9">
                        <label>
                          <input type="file" name="hinh">
                        </label>
                      </div>
                      <div class="col-md-12"  style="padding: 10px 20px">
                        <label>Mô tả
                          <textarea class="form-control col-md-12" name="description" rows="5" id="content"></textarea>
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