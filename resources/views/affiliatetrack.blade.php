@extends('index')
@section('title')
Tracking Campaign | Shorten Link
@endsection
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
 <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">Search</header>
              <div class="panel-body">
                <form class="form-inline" method="GET" role="form">
                  <div class="form-group">
                    <span for="">Search Job Id</span>
                    <input type="text" name="job_id" id="jobsearch" placeholder="Chú ý: Nhập số ID Job" class="form-control">
                  </div>
                   <div class="form-group">
                   
                    <select class="form-control" size="1"  name="email" id="emailsearch">
                      <option value="All">Email</option>
                      @foreach($user as $em)
                        <option value="{{$em->email}}" >{{$em->email}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="input-group input-large" data-date="<?= date('d/m/Y',time());?>" data-date-format="dd-mm-yyyy">
                      <input type="text" class="form-control dpd1 default-date-picker" name="datefrom" id="datefrom">
                      <span class="input-group-addon">To</span>
                      <input type="text" class="form-control dpd2 default-date-picker" name="dateto" id="dateto">
                  </div>
                </form>
              </div>
            </section>
            <div id="contentajaxx">
            <section class="panel">
              <header class="panel-heading">Affiliate Track list</header>
              <div class="panel-body">
                <table class="table table-hover display table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th><i class="fa fa-bookmark"></i> Job ID</th>
                      <th><i class="fa fa-user"></i> Người tạo</th>
                      <th><i class=" fa fa-link"></i> Link rút gọn</th>
                      <th><i class="fa fa-calendar"></i> Ngày/Giờ tạo</th>
                      <!-- <th><i class=" fa fa-calendar"></i> Ngày bắt đầu seeder</th> -->
                      <th><i class="fa fa-bar-chart-o"></i> Thống kê</th>
                      <th><i class=" fa fa-check-square"></i> Aplly</th>
                      <!-- <th><i class=" fa fa-edit"></i> </th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php $stt = 1;?>
                      @foreach($track1 as $tr)
                        <?php $shorturl= $_SERVER['SERVER_NAME']."/".$tr->shortcut_url ?>
                    <tr>
                      <td><span>{{$stt++}}</span></td>
                      <td><span>{{$tr->job_id}}</span></td>
                      <td><span>{{$tr->user->email}}</span></td>
                      <td><p><a href="{{$tr->redirect}}">{{$shorturl}}</a></p></td>
                      <td><span>{{$tr->created_at->format('d-m-Y H:s:i')}}</span></td>
                    
                      <td class="text-center">
                        
                        <a href="subadmin/statictis-details/{{$tr->shortcut_url}}" ><span class="label label-primary label-mini tooltips" data-placement="top" data-original-title="Xem thống kê chi tiết lượt click.">{{$tr->count_click}}</span></a>
                      </td>
                      <td class="text-center">
                        
                          <?php 
                          $pareUrl = parse_url($tr->redirect);
                            if($pareUrl['host'] == 'topdev.vn') {
                              $job_id = $tr->job_id;
                              $email  = $tr->user_create;
                              if(is_numeric($job_id) && isset($email)) {
                                echo '<span class="label label-success label-mini text-center" style="display:inline-block;">';
                                echo '<small class="countApply res-'.$tr->shortcut_url.'" email="'.$email.'" job-id="'.$tr->job_id.'" shortcut_url="'.$tr->shortcut_url.'">
                                        <img src="style-shorten/img/input-spinner.gif">
                                      </small>';
                                echo '</span>';
                              }
                            }
                          ?>
                      </td>
                      <!-- <td><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></td> -->
                    </tr>
                      @endforeach
                  </tbody>
                </table>
                <div class="row-fluid">
                  <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="dataTables_info">
                    <p></p><ul><li>{{$track1->count() }} results</li></ul><p></p>
                    </div>
                  </div>
                  <div class="col-sm-9 col-md-9 col-lg-9">
      
                    <div class="dataTables_paginate paging_bootstrap pagination">
                      <ul>
                        {{$track1->links()}}
                      </ul>
                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
            </div>
          </div>
        </div>
        <!-- page end-->
@endsection

@section('script')
<script type="text/javascript">
      jQuery(document).ready(function($) {

            $('#jobsearch').keyup(function(event) {
              var value = $(this).val();
              var emailsearch=$("#emailsearch").val();
              $.ajax({
                  url: 'admin/searchwithjobAffiate/',
                  type:"GET", 
                  cache:false,
                  data: {
                    "job": value,
                    "emailsearch":emailsearch
                  },
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  async: true,
                  success: function(response){
                  	
                   	if(response=="fail")
                   	{
                   		$("#contentajaxx").html("Không tìm thấy dữ liệu");
                   		alert("Vui lòng nhập Số để tìm!!");
                   	}
                      else if(response=="notfound")
                      {
                          $("#contentajaxx").html("<div class='alert alert-danger'><strong>Không tìm thấy dữ liệu</strong></div>");
                      }
                   else
                   	{
                   		$("#contentajaxx").html(response);
                   	}
                  }
              });
            });   


            $("#datefrom").change(function(event){
                var value = $('#jobsearch').val();
              var datefrom=$(this).val();
               var dateto=$("#dateto").val();
               var emailsearch=$("#emailsearch").val();
                $.ajax({
                  url: 'admin/searchwithjobAffiate/',
                  type:"GET", 
                  cache:false,
                  data: {
                    "job": value,
                    "datefrom":datefrom,
                    "dateto":dateto, 
                     "emailsearch":emailsearch
                  },
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  async: true,
                  success: function(response){
                  	
                    if(response=="fail")
                    {
                    	$("#contentajaxx").html("Không tìm thấy dữ liệu");
                      alert("Vui lòng nhập Số để tìm!!");
                    }
                      else if(response=="notfound")
                      {
                          $("#contentajaxx").html("<div class='alert alert-danger'><strong>Không tìm thấy dữ liệu</strong></div>");
                      }
                   else
                    {
                      $("#contentajaxx").html(response);
                    }
                  }
              });
            });
	
	$("#dateto").change(function(event){
                var value = $('#jobsearch').val();
              var datefrom=$("#datefrom").val();
               var dateto=$(this).val();
               var emailsearch=$("#emailsearch").val();
                $.ajax({
                  url: 'admin/searchwithjobAffiate/',
                  type:"GET", 
                  cache:false,
                  data: {
                    "job": value,
                    "datefrom":datefrom,
                    "dateto":dateto, 
                     "emailsearch":emailsearch
                  },
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  async: true,
                  success: function(response){
                  	
                    if(response=="fail")
                    {
                    	$("#contentajaxx").html("Không tìm thấy dữ liệu");
                      alert("Vui lòng nhập Số để tìm!!");
                    }
                      else if(response=="notfound")
                      {
                          $("#contentajaxx").html("<div class='alert alert-danger'><strong>Không tìm thấy dữ liệu</strong></div>");
                      }
                   else
                    {
                      $("#contentajaxx").html(response);
                    }
                  }
              });
            });

           $("#emailsearch").change(function(event){
                var value = $('#jobsearch').val();
              var datefrom=$("#datefrom").val();
               var dateto=$("#dateto").val();
               var emailsearch=$(this).val();
               
                $.ajax({
                  url: 'admin/searchwithjobAffiate/',
                  type:"GET", 
                  cache:false,
                  data: {
                    "job": value,
                    "datefrom":datefrom,
                    "dateto":dateto,
                    "emailsearch":emailsearch
                  },
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  async: true,
                  success: function(response){
                    
                    if(response=="fail")
                    {
                      $("#contentajaxx").html("Không tìm thấy dữ liệu");
                      alert("Vui lòng nhập Số để tìm!!");
                    }
                      else if(response=="notfound")
                      {
                          $("#contentajaxx").html("<div class='alert alert-danger'><strong>Không tìm thấy dữ liệu</strong></div>");
                      }
                   else
                    {
                      $("#contentajaxx").html(response);
                    }
                  }
              });
            });


      });
    </script>
@endsection
