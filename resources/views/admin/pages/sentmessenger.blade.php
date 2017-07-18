@extends('admin.layout.index')
@section('title')
Sent email for seeder | Shorten Link
@endsection
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- page start-->
        <div class="row">
          <div class="col-sm-12">
	<section class="panel">
	<header class="panel-heading">Gửi thông báo cho các seeder
                <span class="tools pull-right">
                  <a href="javascript:;" class="fa fa-chevron-down"></a>
                  <a href="javascript:;" class="fa fa-times"></a>
                </span>
              </header>
              <div class="panel-body alertContent_1">
                <div class="alert alert-danger">ERROR!<br>Nhập đầy đủ thông tin để gửi thông báo!!</div>
                <form action="http://topdevvn.dev/sent-messenger" method="GET" class="form-horizontal tasi-form data-send">
                	<div class="form-group">
                    <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">User Seeders</label>
                    <div class="col-lg-10 userItem">
                      @foreach($user as $us)
                      <label class="checkbox-inline no-padding-left"><input type="checkbox" id="userSeeder" name="emailMess2Seeder[]" value="{{$us->email}}" > {{$us->name}}</label>
                      @endforeach
                      <label class="checkbox-inline no-padding-left"><input type="checkbox" id="all" value="all"> All</label>
                    </div>
                  </div><!-- end user seeders -->
                  <div class="form-group">
                    <label for="cname" class="control-label col-lg-2">Tiêu đề </label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="title_mess" name="title_mess" value="" placeholder="some title" type="text">
                    </div>
                  </div> <!-- tieu de link  -->
                  <div class="form-group">
                    <label class="control-label col-md-2">Nội dung </label>
                    <div class="col-md-10">
                      <textarea class="form-control" rows="5" name="contentMessage" id='contentMessage'></textarea>
                    </div>
                  </div><!--noi dung mail-->
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-danger" type="submit" >Submit</button>
                    </div>
                  </div><!-- button submit -->
                </form>
              </div>
            </section>
         		<script>
			CKEDITOR.env.isCompatible = true;
			CKEDITOR.replace('contentMessage');
		</script>
          </div>
        </div>
        <!-- page end-->
@endsection

@section('script') 
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#all').change(function() {
      var checkboxes = $(this).closest('.userItem').find(':checkbox');
      if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
      } else {
        checkboxes.prop('checked', false);
      }
    });

    function htmlEntities(str) {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function html_entity_decode(str){
      return $("<p />").html(str).text();
    }

  });
</script>
@endsection