@extends('layout.index')

@section('content')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
      <h1 class="page-header">List your link
          <small>List</small>
        </h1>
      </div>
      <!-- /.col-lg-12 -->
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        @if(session('thongbao'))
        <div class="alert alert-success">
          <strong>{{session('thongbao')}}</strong>
        </div>
        @endif
        <thead>
          <tr align="center">
            <th>Link</th>
            <th>Title</th>
            <th>Shortlink</th>
            <th>Description</th>
            <th>Images</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list as $lst)
          <tr class="odd gradeX" align="center">
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
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
@endsection