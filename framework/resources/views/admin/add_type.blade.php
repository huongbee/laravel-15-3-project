@extends('admin.layout')
@section('content')
  <section id="main-content">
      <section class="wrapper">
        <div class="panel panel-body">
          <section class="content">
              <div class="panel panel-default">
                  <div class="panel-heading"><b>Thêm sản loại phẩm mới</b>
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
                     <form method="POST" enctype="multipart/form-data" action="{{route('admin.add-type-product')}}">
                      {{csrf_field()}}
                      <div class="col-md-6">
                        <label>Tên loại</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                      </div>
                      
                      <div class="col-md-12" style="margin-top:15px">
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