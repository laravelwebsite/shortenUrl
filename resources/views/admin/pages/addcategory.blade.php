@extends('admin.layout.index')
@section('title')
Add Category | Shorten Link
@endsection
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">Thêm Category</header>
                        <div class="panel-body">
                            <div class="alertContent"></div>
                            <div class="form">
                                <div class="form-group">
                                
		              <div class="alert alert-success">
		                  <strong id="thongbao"></strong>
		              </div>
		              <input type="hidden" name="id" id="id" class="form-control" value="">
                                    <label class="col-sm-2 control-label col-lg-2">Tên Category </label>
                                    <div class="col-lg-10">
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-user"></i></span>
                                            <input type="text" name="categoryname" id="categoryname" class="form-control" placeholder="Category name" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10"><a class="btn btn-danger btn-submit-add-user" >Submit</a></div>
                                </div>
                            </div>
                        </div>
                    </section>

                        <section class="panel">
                        <header class="panel-heading">
                            Danh sách Category
                            <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <div class="adv-table">
                                <div id="hidden-table-info_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <table class="display table table-bordered dataTable" id="hidden-table-info" aria-describedby="hidden-table-info_info">
                                        <thead>
                                            <tr role="row">
                                               
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Edit</th>
                                                 <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                                            @foreach($cate as $ct)
                                            <tr>
                                                <td class="text-center ">{{$ct->id}}</td>
                                                <td class="text-center">{{$ct->categoryname}}</td>
                                                <td class="text-center"><a href="admin/edit-category/{{$ct->id}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></td>
                                                <td class="text-center">
                                                <a class="btn btn-danger btn-xs tooltips btn-del-record" id="{{$ct->id}}" data-toggle="modal" data-placement="top" data-original-title="Delete record." href="#recordDel"><i class="fa fa-trash-o "></i></a>
                                              </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row-fluid">
                                        <div class="span6"><div class="dataTables_info" id="hidden-table-info_info">{{$cate->count()}} Result</div></div>
                                        <div class="span6">
                                            <div class="dataTables_paginate paging_bootstrap pagination">
                                                <ul>
                                                    {{$cate->links()}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->

             <!-- Modal recordDel-->
      <div class="modal fade" id="recordDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Delete</h4>
          </div>
            <div class="modal-body">
                Bạn có muốn xóa link trong danh sách chờ duyệt hay không?
                <input type="hidden" id="idRecord" name="idRecord" value="">
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-danger btn-delete" type="button" > Ok</button>
            </div>
          </div>
        </div>
      </div>
      <!-- .modal recordDel-->
@endsection

@section('script')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.btn-submit-add-user').click(function(event) {
            //var id  = $("input[name=id]").val();
            var categoryname  = $("input[name=categoryname]").val();
            if(categoryname.length != 0){
                $.ajax({
                            url: 'admin/addcategory/',
                            type: 'POST',
                             cache:false,
                            data: {
                                "categoryname": categoryname, 
                            },
                             headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                           async: true,
                            beforeSend: function(){
                                $('.alertContent').html('<img src="style-shorten/img/input-spinner.gif">');
                            },
                            success: function(res){

                                var res = $.parseJSON(res);
                                if(res=="update")
                                {
                                        alert("Update Success!!");
                                        location.reload();
                                }
                                else
                                {
                                        alert("Add Success!!");
                                        location.reload();
                                }   
                            }
                        });
            }
    });

    $('.btn-del-record').click(function(event) {
              var flagId = $(this).attr('id');
              $("input[name=idRecord]").val(flagId);
            });
            $('.btn-delete').click(function(event) {
              var id = $("input[name=idRecord]").val();
              $.ajax({
                  url: 'admin/deletecateajax/',
                  type:"POST", 
                  cache:false,
                  data: {
                    "id": id
                  },
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  async: true,
                  success: function(result){
                    $('#recordDel').fadeOut('fast');
                    location.reload();
                  }
              });
            });   
});
</script>
@endsection