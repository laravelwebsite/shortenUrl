@extends('index')
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
                                
		              <div class="alert alert-success">
		                  <strong id="thongbao"></strong>
		              </div>
		              <input type="hidden" name="id" id="id" class="form-control" value="{{$inforuser->id}}">
                                    <label class="col-sm-2 control-label col-lg-2">Thông tin </label>
                                    <div class="col-lg-10">
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-user"></i></span>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Họ và tên" value="{{$inforuser->name}}">
                                        </div>
                        
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-envelope"></i></span>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="example@example.com" value="{{$inforuser->email}}" disabled="">
                                        </div>
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-envelope"></i></span>
                                            <input type="text" name="email_affiliate" id="email_affiliate" class="form-control" placeholder="Email partner - Affiliate" value="{{$inforuser->email_affiliate}}">
                                        </div>
                                        <div class="input-group m-bot15">
                                            <span class="input-group-addon input-group-addon-style"><i class="fa fa-gears"></i></span>
                                            <select class="form-control m-bot15" name="role_id">
                                              <option value="0" 
                                                @if($inforuser->role_id==0)
                                              {{'selected=""'}}
                                              @endif>User</option>
                                              <option value="1" @if($inforuser->role_id==1)
                                              {{'selected=""'}}
                                              @endif>Admin</option>
                                              <option value="2" @if($inforuser->role_id==2)
                                              {{'selected=""'}}
                                              @endif>Sub admin</option>
                                          </select>
                                        </div>

                                    </div>
                                     <div class="input-group m-bot15">Hiển thị thông tin</div>
                                        <div class="input-group m-bot15" style="width: 100%;">
                                            <div class="col-md-6">
                                                <label class="control-label col-md-3">Seeder</label>
                                                <div class="col-md-6">
                                                    <select name="in_seeder" class="multi-select" multiple="" id="my_multi_select3" >
                                                    <?php $arrSeeder = explode('|', $inforuser->in_seeder);?>
                                                        @foreach($user as $us)
                                                        @if($us->email!="Applance")
                                                            <option value="{{$us->email}}"
                                                            <?php echo in_array($us->email, $arrSeeder) ? 'selected' : ''; ?>
                                                            > {{$us->email}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label class="control-label col-md-3">Category</label>
                                                <div class="col-md-6">
                                                    <select name="in_category" class="multi-select" multiple="" id="my_multi_select1" >
                                                    <?php $cateseed = explode('|', $inforuser->in_category);?>
                                                        @foreach($category as $cate)
                                                        <option value="{{$cate->id}}" <?php echo in_array($cate->id, $cateseed) ? 'selected' : ''; ?>>{{$cate->categoryname}}</option>
                                                        @endforeach
                                                    </select>
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
                </div>
            </div>
            <!-- page end-->
@endsection

@section('script')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.btn-submit-add-user').click(function(event) {
            var id  = $("input[name=id]").val();
            var username  = $("input[name=username]").val();
            var password  = $("input[name=password]").val();
            var email     = $("input[name=email]").val();
            var num_phone = $("input[name=num_phone]").val();
            var email_affiliate = $("input[name=email_affiliate]").val();
            var role_id   = $("select[name=role_id]").val();
            var in_seeder = $("select[name=in_seeder]").val();
            var in_category = $("select[name=in_category]").val();
            if(username.length != 0){
                if(isValidEmailAddress(email) && isValidEmailAddress(email_affiliate)){
                    // if($.isNumeric(num_phone) && num_phone.length >= 10 && num_phone.length <= 11){
                        $.ajax({
                            url: 'admin/adduser/',
                            type: 'POST',
                             cache:false,
                            data: {
                                "id":id,
                            	"username": username, 
                            	"password": password,
                            	"phone":num_phone, 
                            	"role_id": role_id, 
                            	"email": email, 
                            	"email_affiliate": email_affiliate, 
                            	"in_seeder":in_seeder, 
                            	"in_category":in_category
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
                                        alert("Updat Success!!");
                                        location.reload();
                                }
                                else
                                {
                                    $('.alertContent').html(res.data);
                                }
                                
                            }
                        });
                    // }else{
                        // $('.alertContent').html('<div class="alert alert-danger alert-block fade in"><h4><i class="fa fa-ok-sign"></i> Error!</h4><p>Điện thoại phải ở dạng chữ số và lớn hơn hoặc bằng 10 kí tự.</p></div>');
                    // }
                }
                else
                {
                    $('.alertContent').html('<div class="alert alert-danger alert-block fade in"><h4><i class="fa fa-ok-sign"></i> Error!</h4><p>Bạn chưa nhập email Hoặc nhập chưa đúng, xin kiểm tra lại.</p></div>');
                }
            }
            else
            {
                $('.alertContent').html('<div class="alert alert-danger alert-block fade in"><h4><i class="fa fa-ok-sign"></i> Error!</h4><p>username vs password không được rổng. Hoặc password phải nhiều hơn 4 ký tự.</p></div>');
            }
        });
    });
  function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
</script>
@endsection