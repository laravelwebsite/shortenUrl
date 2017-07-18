@extends('admin.layout.index')
@section('title')
Tạo link Admin
@endsection
@section('content')
<!-- page start-->
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">
        Tạo link shorten 
        <span class="tools pull-right">
          <a href="javascript:;" class="fa fa-chevron-down"></a>
          <a href="javascript:;" class="fa fa-times"></a>
        </span>
      </header>
      <div class="panel-body">
        <form class="form-horizontal tasi-form" enctype="multipart/form-data" method="post" action="admin/taolink">   
          @if(count($errors)>0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong>There were some problems with your input! <br><br>
            <ul>
              @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
            </ul> 
          </div>
          @endif
          @if(session('thongbao'))
          <div class="alert alert-success">
            <strong>{{session('thongbao')}}</strong>
          </div>
          @endif
          @if(session('loi'))
          <div class="alert alert-danger">
            <strong>{{session('loi')}}</strong>
          </div>
          @endif
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group flag-seeder">
            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">User Seeders</label>
            <div class="col-lg-10 userItem">
              @foreach($user as $us)
              <label class="checkbox-inline no-padding-left"><input type="checkbox" id="seeder_id" name="seeder_id[]" value="{{$us->id}}"> {{$us->name}}</label>
              @endforeach
              <label class="checkbox-inline no-padding-left"><input type="checkbox" id="all" > All [seeders]</label>
            </div>
          </div><!-- end user seeders -->   

          <div class="form-group">
            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Category </label>
            <div class="col-lg-10">
              <select class="form-control m-bot15" name="category" id="category">
                @foreach($category as $cate)
                      <option value="{{$cate->id}}" >{{$cate->categoryname}}</option>
                @endforeach
              </select>
            </div>
          </div><!-- Category -->       
          <div class="form-group ">
            <label for="curl" class="control-label col-lg-2">Đường dẫn cần rút gọn </label>
            <div class="col-lg-10">
              <input class="form-control " id="curl" type="url" name="url" required=""  placeholder="http://example.com">
            </div>
          </div><!-- Url defautl-->
          <div class="form-group flag-fb-seeder">
            <label for="cname" class="control-label col-lg-2">Tiêu đề </label>
            <div class="col-lg-10">
              <input class=" form-control" id="title" name="title" placeholder="Subject"  type="text">
            </div>
          </div> <!-- tieu de link  -->

          <div class="form-group flag-fb-seeder">
            <label for="ccomment" class="control-label col-lg-2">Tóm tắt </label>
            <div class="col-lg-10">
              <textarea class="form-control " id="description" name="description" rows="4"></textarea>
            </div>
          </div> <!-- noi dung tom tat -->

          <div class="form-group flag-fb-seeder">
            <label class="control-label col-sm-2">Hình ảnh </label>
            <div class="controls col-sm-10">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <span class="btn-white btn-file-style">
                  <input type="file" name="fileUpload" id="fileUpload" class="default">
                </span>
              </div>
            </div>
          </div><!-- end input upload images -->

          <div class="form-group flag-fb-seeder" style="display: none;">
            <label class="col-sm-2 control-label">Ngày bắt đầu seeder</label>
            <div class="col-sm-5">
              <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" class="input-append date dpYears">
                <input type="text" name="date_begin_seeder" id="date_begin_seeder" value="{{date('d-m-Y')}}" size="16" class="form-control">
                <span class="input-group-btn add-on">
                  <button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
                </span>
              </div>
            </div>
          </div><!-- end date begin seeder -->

          <!-- end facebook -->

          <div class="form-group ">
            <label for="cname" class="control-label col-lg-2">Mục đích </label>
            <div class="col-lg-10">
              <input class=" form-control" id="purpose" name="purpose" placeholder=""  type="text">
              <p class="help-block-style"><span class="note">Other này chỉ dành cho các hoạt động không liên quan đến Job và vận hành</span></p>
            </div>
          </div> <!-- muc dich -->
          <div class="form-group job-id">
            <label for="cname" class="control-label col-lg-2">JobID </label>
            <div class="col-lg-10">
            <input class=" form-control" id="job_id" name="job_id"  placeholder="N/A" type="text">
              <p class="help-block-style">Nhập nhiều Job ID cách nhau bằng dấu phẩy (100, 1000)</p>
            </div>
          </div> <!-- .job id -->
          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
              <button class="btn btn-danger" type="submit">Submit</button>
            </div>
          </div><!-- button submit -->
        </form>
      </div>
    </section>
  </div>
</div>
<!-- form add shorten link -->
<!-- page end-->
@endsection

@section('script')
<script>
  jQuery(document).ready(function($) {
    var value = $('#category').val();
    $('.flag-fb-seeder').show();
    
    // if(value != 'Others') $('div.job-id').show();
    // else $('div.job-id').hide();

    $('#category').bind('change keyup', function(event) {
      var value = $('#category').val(), note = $(this).find(':selected').data('note');
      $('.note').html(note);

      if(value == 3) $('.flag-seeder').fadeIn(500);
      else $('.flag-seeder').fadeOut(200);
      
      if(value ==3 || value == 9) $('.flag-fb-seeder').fadeIn(500);
      else $('.flag-fb-seeder').fadeOut(200);

      // if(value == 'Others') $('div.job-id').hide();
      // else $('div.job-id').show();
      
    });// change category show flag fb seeder

    $('#all').change(function() {
      var checkboxes = $(this).closest('.userItem').find(':checkbox');
      if($(this).is(':checked')) 
      {
        checkboxes.prop('checked', true);
      } 
      else 
      {
        checkboxes.prop('checked', false);
      }
    });// checkbox all user seeder

  });
</script>
@endsection
