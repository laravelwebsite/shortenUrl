@extends('admin.layout.index')
@section('title')
Add Users Seeding | Shorten Link
@endsection
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">Tạo mới user seeding</header>
                        <div class="panel-body">
                            <div class="alertContent"></div>
                            <div class="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label col-lg-2">Thông tin </label>
                                    <div class="col-lg-10">
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-user"></i></span>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Họ và tên" value="">
                                        </div>
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-lock"></i></span>
                                            <input type="password" name="password" id="password" class="form-control" value="">
                                        </div>
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-envelope"></i></span>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="example@example.com" value="" >
                                        </div>
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-envelope"></i></span>
                                            <input type="text" name="email_affiliate" id="email_affiliate" class="form-control" placeholder="Email partner - Affiliate" value="">
                                        </div>
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-gears"></i></span>
                                            <select class="form-control m-bot15" name="role_id">
                                              <option value="0" selected="">User</option>
                                              <option value="1" >Admin</option>
                                              <option value="2" >Sub admin</option>
                                          </select>
                                        </div>
                                        <div class="input-group m-bot15">Hiển thị thông tin</div>
                                        <div class="input-group m-bot15" style="width: 100%;">
                                            <div class="col-md-6">
                                                <label class="control-label col-md-3">Seeder</label>
                                                <div class="col-md-6">
                                                    <select name="in_seeder" class="multi-select" multiple="" id="my_multi_select3" >
                                                        @foreach($user as $us)
                                                        @if($us->email!="Applance")
                                                            <option value="{{$us->email}}"> {{$us->email}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label col-md-3">Category</label>
                                                <div class="col-md-6">
                                                    <select name="in_category" class="multi-select" multiple="" id="my_multi_select1" >
                                                        @foreach($category as $cate)
                                                        <option value="{{$cate->id}}">{{$cate->categoryname}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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
                            Danh sách user
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
                                                <th style="width: 19px;"></th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Date created at</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                                            <?php $stt = 1;?>
                                            @foreach($user as $us)
                                            <tr>
                                                <td class="text-center ">{{$stt}}</td>
                                                <td class="">{{$us->name}} 
                                                @if($us->role_id == 1) 
                                                	{!!'<span class="text-muted small"> - admin</span>'!!}
				     @endif
                                                	</td>
                                                <td class="">{{$us->email_user}}</td>
                                                <td class="">{{$us->created_at->format('d-m-Y')}}</td>
                                                <td class="text-center"><a href="add-user-sedding/{{$us->id}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- <div class="row-fluid">
                                        <div class="span6"><div class="dataTables_info" id="hidden-table-info_info">Showing 1 to 10 of 57 entries</div></div>
                                        <div class="span6">
                                            <div class="dataTables_paginate paging_bootstrap pagination">
                                                <ul>
                                                    <li class="prev disabled"><a href="#">← Previous</a></li>
                                                    <li class="active"><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">5</a></li>
                                                    <li class="next"><a href="#">Next → </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> -->
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
        	alert("click");
            var username  = $("input[name=username]").val(),
                password  = $("input[name=password]").val(),
                email     = $("input[name=email]").val(),
                num_phone = $("input[name=num_phone]").val(),
                email_affiliate = $("input[name=email_affiliate]").val(),
                role_id   = $("select[name=role_id]").val(),
                in_seeder = $("select[name=in_seeder]").val(),
                in_category = $("select[name=in_category]").val();
            if(username.length != 0 && password.length > 4 ){
                if(isValidEmailAddress(email) && isValidEmailAddress(email_affiliate)){
                    // if($.isNumeric(num_phone) && num_phone.length >= 10 && num_phone.length <= 11){
                        $.ajax({
                            url: 'admin/adduser/',
                            type: 'GET',
                            data: {username: username, password: password, role_id: role_id, email: email, email_affiliate: email_affiliate, in_seeder:in_seeder, in_category:in_category},
                            beforeSend: function(){
                                $('.alertContent').html('<img src="style-shorten/img/input-spinner.gif">');
                            },
                            success: function(res){
                            	alert("true");
                                var res = $.parseJSON(res);
                                $('.alertContent').html(res.data);
                            }
                        });
                    // }else{
                        // $('.alertContent').html('<div class="alert alert-danger alert-block fade in"><h4><i class="fa fa-ok-sign"></i> Error!</h4><p>Điện thoại phải ở dạng chữ số và lớn hơn hoặc bằng 10 kí tự.</p></div>');
                    // }
                }else{
                    $('.alertContent').html('<div class="alert alert-danger alert-block fade in"><h4><i class="fa fa-ok-sign"></i> Error!</h4><p>Bạn chưa nhập email Hoặc nhập chưa đúng, xin kiểm tra lại.</p></div>');
                }
            }else{
                $('.alertContent').html('<div class="alert alert-danger alert-block fade in"><h4><i class="fa fa-ok-sign"></i> Error!</h4><p>username vs password không được rổng. Hoặc password phải nhiều hơn 4 ký tự.</p></div>');
            }
        });
    });
  function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
@endsection