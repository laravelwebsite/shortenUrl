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
                <form class="form-inline" role="form">
                  <div class="form-group">
                    <span for="">Search Job Id</span>
                    
                    <input type="text" name="job_id" id="jobsearch" placeholder="Chú ý: Nhập số ID Job" class="form-control">
                  </div>
                  <div class="form-group">
                    <span for="">Category </span>
                    <select class="form-control" name="category" id="category" >
                      <option value="All">All</option>
                      @foreach($category as $cate)
                      <option value="{{$cate->id}}" >{{$cate->categoryname}}</option>
                      @endforeach
                    </select>
                  </div>
                </form>
              </div>
            </section>
            <div id="contentajax">
            <section class="panel">
              <header class="panel-heading">Tracking campaign</header>
              <div class="panel-body">
                <table class="table table-hover display table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th class="text-center">JobID</th>
                      <th class="text-center"><i class="fa fa-user"></i></th>
                      <th><i class="fa fa-link"></i> Link rút gọn</th>
                      <th><i class="fa fa-list"></i> Category</th>
                      <th class="text-center"><i class="fa fa-calendar"></i><!-- Date tạo --></th>
                      <th class="text-center">BeginSeeder</th>
                      <th class="text-center"><i class="fa fa-bar-chart-o"></i> </th>
                      <th class="text-center"><i class="fa fa-check-square"></i> </th>
                      <th><i class="fa fa-sticky-note"></i> Region</th>
                      <th><i class="fa fa-sticky-note"></i> Note</th>
                      <th class="text-center" style="width: 70px;"><i class="fa fa-edit"></i> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $stt = 1;?>
                      @foreach($track as $tr)
                      <?php $shorturl= $_SERVER['SERVER_NAME']."/".$tr->shortcut_url  ?>
                    <tr>
                      <td><span>{{$stt++}}</span></td>
                      <td><span>{{$tr->job_id}}</span></td>
                      <td><span <?=$tr->email_user == 'Applancer' ? $tr->email_user : 'style="color:red;"'; ?>><?=strlen($tr->user->name) ? $tr->user->name : 'Applancer';?></span></td>
                      <td><p><a href="{{$tr->redirect}}" title="{{$tr->redirect}}">{{$shorturl}}</a></p></td>
                      <td><span>{{$tr->category['categoryname']}}</span></td>
                      <td><span>{{$tr->created_at->format('d-m-Y')}}</span></td>
                      <td><span>{{$tr->date_begin_seeder}}</span></td>
                      <td class="text-center">
                        <a href="admin/statictis-details/{{$tr->shortcut_url}}" ><span class="label label-primary label-mini tooltips" data-placement="top" data-original-title="Xem thống kê chi tiết lượt click.">{{$tr->count_click}}</span></a>
                      </td>
                      <td class="text-center">
                          <?php 
                              if(isset($tr->job_id) && is_numeric($tr->job_id)){
                                echo '<span class="text-center label label-success label-mini tooltips" data-placement="top" data-original-title="Apply" style="display:inline-block;">';
                                echo '<small class="countApply res-'.$tr->shortcut_url.'" idUser="'.$tr->user->id.'" job-id="'.$tr->job_id.'" shortcut_url="'.$tr->shortcut_url.'">
                                       <img src="style-shorten/img/input-spinner.gif">
                                     </small>';
                                echo '</span>';
                              }
                          ?>
                      </td>
                      <td><span><?php if($tr->region=="") echo "N/A";else echo  $tr->region;?></span></td>
                      <td><span><?php if($tr->purpose=="") echo "Nothing";else echo  $tr->purpose;?></span></td>
                      <td class="text-center">
                        <a class="btn btn-danger btn-xs tooltips btn-del-record" id="{{$tr->id}}" data-toggle="modal" data-placement="top" data-original-title="Delete record." href="#recordDel"><i class="fa fa-trash-o "></i></a>
                      </td>
                    </tr>
                       @endforeach
                    <!-- .record  -->
                  </tbody>
                </table>
                <div class="row-fluid">
                  <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="dataTables_info">
                    <p></p><ul><li>{{$count}} results
                    </li></ul><p></p>
                    </div>
                  </div>
                  <div class="col-sm-9 col-md-9 col-lg-9">
                    
                    <div class="dataTables_paginate paging_bootstrap pagination">
                      <ul>
                        {{$track->links()}}

                      </ul>
                    </div>  
                  </div>
                </div>
            </section>
            </div>
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

            $('#jobsearch').keyup(function(event) {
              var value = $(this).val();
              var valuecate=$("#category").val();
              $.ajax({
                  url: 'admin/searchwithjobTrackcampaign/',
                  type:"GET", 
                  cache:false,
                  data: {
                    "key": value,
                    "key1":valuecate
                  },
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  async: true,
                  success: function(response){
                   	if(response=="fail")
                   	{
                   		alert("Vui lòng nhập Số để tìm!!");
                   	}
                      else if(response=="notfound")
                      {
                          $("#contentajax").html("<div class='alert alert-danger'><strong>Không tìm thấy dữ liệu</strong></div>");
                      }
                   else
                   	{
                   		$("#contentajax").html(response);
                   	}
                  }
              });
            });   


            $("#category").change(function(event){
                var valuecate=$(this).val();
                var valuejob = $('#jobsearch').val();
                $.ajax({
                  url: 'admin/searchwithjobTrackcampaign/',
                  type:"GET", 
                  cache:false,
                  data: {
                    "key": valuejob,
                    "key1":valuecate
                  },
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  async: true,
                  success: function(response){
                    if(response=="fail")
                    {
                      alert("Vui lòng nhập Số để tìm!!");
                    }
                      else if(response=="notfound")
                      {
                          $("#contentajax").html("<div class='alert alert-danger'><strong>Không tìm thấy dữ liệu</strong></div>");
                      }
                   else
                    {
                      $("#contentajax").html(response);
                    }
                  }
              });
            });

           $('.btn-del-record').click(function(event) {
              var flagId = $(this).attr('id');
              
              $("input[name=idRecord]").val(flagId);
            });
            $('.btn-delete').click(function(event) {
              var id = $("input[name=idRecord]").val();
              $.ajax({
                  url: 'user/deleteajax/',
                  type:"GET", 
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