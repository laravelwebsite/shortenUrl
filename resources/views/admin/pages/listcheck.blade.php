@extends('index')
@section('title')
Tạo link Admin
@endsection
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">Danh sách chờ duyệt</header>
              <table class="table table-hover display table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th><i class="fa fa-link"></i> Link gốc</th>
                    <th><i class="fa fa-user"></i> Người tạo</th>
                    <th class="text-center"><i class="fa fa-edit"></i> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $stt = 1;?>
                 @foreach($listcheck as $list)
                  <tr>
                    <td><span>{{$stt++}}</span></td>
                    <td><p><a href="{{$list->redirect}}">{{$list->redirect}}</a></p></td>
                    <td><span>{{$list->email_user}}</span></td>
                    <td class="text-center">
                      <a class="btn btn-primary btn-xs tooltips btn-update-content-seeder" data-placement="top" data-original-title="Add content for user seeder." idWaitCheck="{{$list->id}}" data-toggle="modal" href="#modalEditContentSeeders"><i class="fa fa-pencil "></i></a>
                      <a class="btn btn-danger btn-xs tooltips btn-del-record-listCheck" data-placement="top" data-original-title="Delete record." data-flagId="{{$list->id}}" data-toggle="modal" href="#recordDel"><i class="fa fa-trash-o "></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="row-fluid">
                <div class="col-sm-3 col-md-3 col-lg-3">
                 <div class="dataTables_info">
                  <p><ul><li>{{$listcheck->count()}} results</li></ul></p>
                  </div>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <ul>
                  	{{$listcheck->links()}}
                  </ul>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
        <!-- page end-->

        <!-- modal add content to seeder-->
      <div class="modal fade modal-dialog-center top-modal-with-space" id="modalEditContentSeeders" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Content seeding</h4>
              </div>
              <div class="modal-body">
                <div class="alertResult"></div>
                <form action="" method="POST" id="frm_contSeeder">
                  <div class="form-group user-seeder-a users">
                    @foreach($user as $us)
                      <label class="checkbox-inline no-padding-left"><input type="checkbox" id="idSeeder" name="idSeeder[]" value="{{$us->id}}"> {{$us->name}}</label>
                    @endforeach
                      <label class="checkbox-inline no-padding-left"><input type="checkbox" id="allCheckbox" name="#" value="#"> All [seeders]</label>
                  </div><!-- end user seeders -->
                  <div class="form-group">
                    <textarea class="form-control " id="content_seeder" name="content_seeder" rows="9"></textarea>
                  </div> <!-- noi dung tom tat -->
                  <input type="hidden" name="idListWaitCheck" id="idListWaitCheck" value="">
                </div>
              </form>
              <div class="modal-footer">
                <a data-dismiss="modal" class="btn btn-default" >Close</a>
                <a class="btn btn-danger btn-update-contSeeder"> Save changes</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- .modal add content to seeder-->
    <!-- Modal Delete-->
    <div class="modal fade" id="recordDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete</h4>
        </div>
          <div class="modal-body">
            Bạn có muốn xóa link trong danh sách chờ duyệt hay không?
          </div>
          <div class="modal-footer">
            <a data-dismiss="modal" class="btn btn-default">Close</a>
            <input type="hidden" name="flagIdDel" value="">
            <a class="btn btn-danger btn-delete"> Ok</a>
          </div>
        </div>
      </div>
    </div>
    <!-- modal Delete-->
    <!--main content end-->
@endsection
@section('script')
<script type="text/javascript">
      jQuery(document).ready(function($) {

            $('.btn-del-record-listCheck').click(function(event) {
              var flagId = $(this).attr('data-flagId');
              $("input[name=flagIdDel]").val(flagId);
            });
            $('.btn-delete').click(function(event) {
              var id = $("input[name=flagIdDel]").val();
              $.ajax({
                  url: 'admin/deleteajaxadmin/',
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

            //check all
            $('#allCheckbox').change(function() {
	      var checkboxes = $(this).closest('.users').find(':checkbox');
	      if($(this).is(':checked')){
	        checkboxes.prop('checked', true);
	      } else {
	        checkboxes.prop('checked', false);
	      }
	    });// checkbox all user seeder

            //check listbox check
            $('.btn-update-content-seeder').click(function(event) {
	      var idWaitCheck = $(this).attr('idWaitCheck');
	      $('#idListWaitCheck').val(idWaitCheck);
	      $.ajax({
	        url: 'admin/ListCheck',
	        type: 'GET',
	        cache:false,
	        data: {idSeeder: idWaitCheck},
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	        async: true,
	        beforeSent: function(){
	          $('.user-seeder-a').html('<img src="style-shorten/img/input-spinner.gif">');
	        },
	        success: function(res){
	          var res = $.parseJSON(res);
	          $('.user-seeder-a').html(res.data);

	        },

	      });
	    });


            $('.btn-update-contSeeder').click(function(event) {
	      var dataFrm = $('#frm_contSeeder').serialize();
         
	      $.ajax({
	        url: 'admin/UpContSeeder',
	        type: 'get',
	        data: dataFrm,
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	        beforeSent: function(){
	          $('.alertResult').html('<img src="style-shorten/img/input-spinner.gif">');
	        },
	        success: function(result){
	          $('#recordDel').fadeOut('fast');
                    location.reload();
	        }
	      });
	    });


      });
    </script>
@endsection