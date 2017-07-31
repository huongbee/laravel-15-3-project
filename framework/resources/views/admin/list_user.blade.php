@extends('admin.layout')
@section('content')
  <section id="main-content">
      <section class="wrapper">
        <div class="panel panel-body">
          <section class="content">
              <div class="panel panel-default">
                  <div class="panel-heading"><b>Danh sách người dùng</b>
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
                            <th>Email</th>
                            <th>Ảnh đại diện</th>
                            <th>Admin?</th>
                            <th>Sửa | Xóa</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $p)
                          <tr>
                            <td>{{$p->full_name}}</td>
                            <td>{{$p->email}}</td>
                            <td>
                                <img src="@if($p->avatar!=NULL){{$p->avatar}} @else admin_theme/img/users/user.png @endif" style="width: 100px">
                            </td>
                            <td id="user_{{$p->id}}">
                              @if($p->admin==1) Admin
                              @else Người dùng
                              @endif
                            </td>
                            <td>
                              <a id="edit_{{$p->id}}" data-toggle="modal" data-target="#myModal"  id_user="{{$p->id}}">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
                              </a> | 
                              <a href="{{route('delete_user',$p->id)}}">
                                <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                              </a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>

                      </table>
                      {{$user->links()}}
                  </div>
              </div>
          </section>
        </div>
      </section>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
          <label id="mark_admin" id_user=""><input type="checkbox" name="admin"> Đánh dấu là Admin</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <script src="admin_theme/js/jquery.js"></script>
  <script>
    $(document).ready(function(){

      $('a[id^="edit_"]').click(function(){
        var id_user = $(this).attr('id_user');

        $('#myModal').on('show.bs.modal', function () {
           $('#mark_admin').attr('id_user',id_user)
        });

        $('#mark_admin').click(function(){

          var check = $('input[name="admin"]:checked').length > 0
          if(check==true){
            id_user = ($(this).attr('id_user'))
            
            if(id_user.length > 0){
              console.log(id_user)
              $.ajax({
                url:"{{route('edit_user')}}",
                type:'GET',
                data:{
                  user:id_user
                },
                success:function(){
                  $('#myModal').on('hidden.bs.modal', function () {
                    $('#user_'+id_user).html('Admin')
                  })
                },
                error:function(){
                  console.log('error')
                }
              })
            }
            $('#mark_admin').attr('id_user','')
          }
        })
        

      })
      $('#myModal').on('hidden.bs.modal', function () {
          $(this).find("input").prop("checked", "").end();
      });
    })
  </script>
@endsection