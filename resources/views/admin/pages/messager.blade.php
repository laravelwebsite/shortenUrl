@extends('admin.layout.index')
@section('title')
Thông báo
@endsection
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- page start-->
        <div class="row">
          <div class="col-sm-12">
		<div class="mail-box">
              <aside class="sm-side">
                <div class="user-head">
                  <a href="javascript:;" class="inbox-avatar">
                    <img src="style-shorten/img/no-avatar.png" alt="" style="width: 60px;">
                  </a>
                  <div class="user-name" style="text-overflow: hidden;">
                    <h5>{{Auth::user()->name}}</h5>
                    <span style="display: inline-block; width: 175px;">{{Auth::user()->email}}</span>
                  </div>
                </div>
                  <ul class="nav nav-pills nav-stacked labels-info ">
                  @foreach($messager as $mes)
                  <li> <a class="view-detail-mess" data-id="{{$mes->id}}"> <i class=" fa fa-circle <?= ($mes->flag == 1) ? 'text-muted' : 'text-danger';?>"></i> {{$mes->title_messager}} <p>{{$mes->created_at->format('d-m-Y')}}</p></a> </li>
                  @endforeach
                  <!-- <li> <a href="#"> <i class=" fa fa-circle text-danger"></i> Sumon <p>Busy with coding</p></a> </li> -->
                </ul>
                
                
                <div class="inbox-body text-center">
                  <div class="btn-group">
                    <a href="javascript:;" class="btn mini btn-info">1</a>
                  </div>
                  <div class="btn-group">
                    <span class="btn mini btn-success disables">2</span>
                  </div>
                  <div class="btn-group">
                    <a href="javascript:;" class="btn mini btn-info">3</a>
                  </div>
                </div>
              </aside>
              <aside class="lg-side">
                <div class="inbox-head"><h3>View Mail</h3></div>
                <div class="inbox-body contentMess">
                  No content
                </div>
              </aside><!-- .email view -->
            </div>
          </div>
        </div>
        <!-- page end-->
        @endsection

@section('script')
<script type="text/javascript">
  jQuery(document).ready(function($) {

    $('.view-detail-mess').click(function(event) {
      var id = $(this).attr('data-id');
      //var _token=$("form[name='showmess']").find("input[name='_token']").val();
      $.ajax({
        url: 'user/Ajaxmessengers/',
        type:"GET", 
        cache:false,
        data: {"id": id},
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        async: true,
        success: function(result){
            $(".contentMess").html(
                result.content_messager
              );
        },
    });
         
    });
  });


</script>
@endsection