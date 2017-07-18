@extends('admin.layout.index')

 @section('content')
<!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      User Table
                  </header>
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <a href="admin/link/add"><button class="btn green">
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
                                  <th>Link</th>
                                  <th>Title</th>
                                  <th>Shortlink</th>
                                  <th>Description</th>
                                  <th>Images</th>
                                  <th>Delete</th>
                                  <th>Edit</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($link as $lst)
                              <tr class="">
                                  <td>{{$lst->link}}</td>
                                  <td>{{$lst->title}}</td>
                                  <td>{{$lst->shortlink}}</td>
                                  <td>{{$lst->description}}</td>
                                  <td>
                                    @if($lst->image!="")
                                    <img src="upload/imagesupload/{{$lst->image}}" alt="" width="200px">
                                    @else {{'Empty'}}
                                    @endif
                                  </td>
                                  <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/link/delete/{{$lst->id}}"> Delete</a></td>
                                  <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/link/edit/{{$lst->id}}">Edit</a></td>
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