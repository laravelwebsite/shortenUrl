@extends('index')
@section('title')
Thống kê
@endsection
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
   <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
    <section class="panel">
              <div class="panel-heading">
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <form action="" method="POST" class="form-inline" role="form">
                    <div class="form-group">
                      <label for="">Search Job Id</label>
                      <select class="form-control" size="1" name="job_id" aria-controls="dynamic-table">
                        <option value="N/A" selected="">N/A</option>
                      @foreach($job_id as $job)
                        <option value="{{$job->job_id}}"  >{{$job->job_id}}</option>
                      @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Sent</button>
                  </form>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <header class="text-right">#</header>
                </div>
                <div class="clearfix"> </div>
              </div>
              <table class="table table-hover display table-bordered">
              @if(session('thongbao'))
                <div class="alert alert-success">
                  <strong>{{session('thongbao')}}</strong>
              </div>
              @endif
                <thead>
                  <tr>
                    <th>#</th>
                    <th><i class="fa fa-bookmark"></i> Job ID</th>
                    <th><i class=" fa fa-link"></i> Link rút gọn</th>                   
                    <th><i class=" fa fa-calendar"></i> Ngày/Giờ tạo</th>
                    <th class="text-center"><i class="fa fa-bar-chart-o"></i> Thống kê</th>
                    <th class="text-center"><i class=" fa fa-check-square"></i> Aplly</th>
                    <th class="text-center"><i class=" fa fa-edit"></i> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      $stt=1;
                        //$redirect = URL.'s/'.$value_statictis_user_seeder->shortcut_url;
                        //$job_id = $value_statictis_user_seeder->job_id;
                  ?>
                  @foreach($danhsach as $ds)
                  <tr>
                    <td><span>{{$stt++}}</span></td>
                    <td><span>{{$ds->job_id}}</span></td>
                    <td><p><a href="{{$ds->redirect}}">{{$_SERVER['SERVER_NAME'].'/'.$ds->shortcut_url}}</a></p></td>
                    <td><span>{{$ds->created_at}}</span></td>
                    <td class="text-center">
                      <span class="label label-primary label-mini">
                        <a href="user/statictis-details/{{$ds->shortcut_url}}" style="color:white;">{{$ds->count_click}}</a>
                      </span>
                    </td>
                    <td class="text-center">
                          <span class="label label-success label-mini text-center" style="display:inline-block;">
                          <small>
                                  <img src="style-shorten/img/input-spinner.gif">
                                </small>
                          </span>
                    </td>
                    <td class="text-center">
                     
                      <a class="btn btn-default btn-xs tooltips btn-content-seeder" data-placement="top" data-original-title="Xem thông tin seeder." data-flagId="{{$ds->id}}" data-toggle="modal" href="#contentSeeder"><i class="fa fa-eye "></i></a>
                      <a class="btn btn-danger btn-xs tooltips btn-del-record" id="{{$ds->id}}" data-toggle="modal" data-placement="top" data-original-title="Delete record." href="#recordDel"><i class="fa fa-trash-o "></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="row-fluid">
                <div class="col-sm-3 col-md-3 col-lg-3">
                 <div class="dataTables_info">
                  <p><ul><li>{{$count}} results</li></ul></p>
                  </div>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <ul>
                    {{$danhsach->links()}}
                  </ul>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>

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
        <!-- Modal -->
        <div class="modal fade " id="contentSeeder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close close-content-seeder" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Thông tin seeder</h4>
              </div>
              <div class="modal-body contentSeederBody">
                Body goes here...
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- page end-->
@endsection

@section('script')
<script type="text/javascript">
      jQuery(document).ready(function($) {

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