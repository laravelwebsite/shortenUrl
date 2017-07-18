@extends('admin.layout.index')

 @section('content')
<!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Link Table
                  </header>
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <a href="admin/user/add"><button class="btn green">
                                      Add New <i class="fa fa-plus"></i>
                                  </button></a>
                              </div>
                              <div class="btn-group pull-right">
                                  <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                  </button>
                                  <ul class="dropdown-menu pull-right">
                                      <li><a>Print</a></li>
                                      <li><a>Save as PDF</a></li>
                                      <li><a>Export to Excel</a></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="space15"></div>
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                          @if(session('thongbao'))
                          <div class="alert alert-success">
                            <strong>{{session('thongbao')}}</strong>
                          </div>
                          @endif
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Tên</th>
                                  <th>Email</th>
                                  <th>Quyền</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($userr as $us)
                              <tr class="">
                                  <td>{{$us->id}}</td>
                                  <td>{{$us->name}}</td>
                                  <td>{{$us->email}}</td>
                                  <td class="center">
                                  @if($us->role_id==1 || $us->role_id==2)
                                    <b style="color: #FF0000">{{"Admin"}}</b>
                                @else <b style="color: #00FF00">{{"User"}}</b>
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/delete/{{$us->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/edit/{{$us->id}}">Edit</a></td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </section>
              <!-- page end-->
@endsection

@section('script')
<script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
</script>
@endsection