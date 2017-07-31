@extends('admin.layout')
@section('content')
  <section id="main-content">
      <section class="wrapper">
        <div class="panel panel-body">
          <section class="content">
              <div class="panel panel-default">
                  <div class="panel-heading"><b>Danh sách loại sản phẩm</b>
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
                            <th width="60%">Mô tả</th>
                            <th>Hình</th>
                            <th>Sửa | Xóa</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $p)
                          <tr>
                            <td>{{$p->name}}</td>
                            <td  width="60%"><?=($p->description)?></td>
                            <td>
                                <img src="shopping/image/product/{{$p->image}}" style="width: 100px">
                            </td>
                            <td>
                              <a href="{{route('admin.edit_type_product',$p->id)}}">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
                              </a> | 
                              <a href="{{route('admin.delete_type_product',$p->id)}}">
                                <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                              </a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>

                      </table>
                      {{$types->links()}}
                  </div>
              </div>
          </section>
        </div>
      </section>
  </section>
@endsection