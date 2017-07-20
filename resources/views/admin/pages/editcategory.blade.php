@extends('index')
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
                        <header class="panel-heading">Sửa Category</header>
                        <div class="panel-body">
                            <div class="alertContent"></div>
                            <div class="form">
                                <div class="form-group">
                                
		              <div class="alert alert-success">
		                  <strong id="thongbao"></strong>
		              </div>
		              <input type="hidden" name="id" id="id" class="form-control" value="{{$cate->id}}">
                                    <label class="col-sm-2 control-label col-lg-2">Tên Category </label>
                                    <div class="col-lg-10">
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-user"></i></span>
                                            <input type="text" name="categoryname" id="categoryname" class="form-control" placeholder="Category name" value="{{$cate->categoryname}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10"><a class="btn btn-danger btn-submit-add-user" >Submit</a></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
@endsection

@section('script')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.btn-submit-add-user').click(function(event) {
            var id  = $("input[name=id]").val();
            var categoryname  = $("input[name=categoryname]").val();
            if(categoryname.length != 0){
                $.ajax({
                            url: 'admin/addcategory/',
                            type: 'POST',
                             cache:false,
                            data: {
                                "id":id,
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
});
</script>
@endsection