@extends('admin.layout.index')
@section('title')
Thống kê chi tiết 
@endsection
@section('content')
<!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading"><i class="fa fa-bar-chart-o"></i> Thống kê chi tiết </header>
              <table class="table table-hover display table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th><i class="fa fa-link"></i> Link các diễn đàn/nhóm</th>
                    <th class="text-center"><i class="fa fa-bar-chart-o"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $total = 0;
                    $stt = 1;
                  ?>
                  @foreach($seeder as $sd)
                  <tr>
                    <td><span>{{$stt++}}</span></td>
                    <td><p><a href="{{$sd->referer}}">{{$sd->referer}}</a></p></td>
                    <td class="text-center"><span>{{$sd->count_click}}</span></td>
                  </tr>
                  <?php $total += $sd->count_click; ?>
                  @endforeach
                  
                  <tr>
                    <td class="text-right" colspan="2">Tổng cộng: </td>
                    <td class="text-center">{{$total}}</td>
                  </tr>
                </tbody>
              </table>
            </section>
            <section class="panel">
              <div class="col-lg-12">
                <div id="accordion" class="panel-group m-bot20">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                          <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">1# Thống kê theo ngày</a>
                      </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="collapseOne">
                      <div class="panel-body">
                        <table class="table table-hover display table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th><i class="fa fa-link"></i> Ngày seeder</th>
                              <th class="text-center"><i class="fa fa-bar-chart-o"></i> Thống kê</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php  $sttd= 1;?>
                          @foreach($dmy_statictis as $dmy)
                            <tr>
                              <td><span>{{$sttd++}}</span></td>
                              <td><p>{{$dmy->date_statictis}}</p></td>
                              <td class="text-center"><span>{{$dmy->count_click}}</span></td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                          <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">2# Thống kê theo tuần</a>
                      </h4>
                    </div>
                    <div class="panel-collapse collapse" id="collapseTwo">
                      <div class="panel-body">
                        <table class="table table-hover display table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th><i class="fa fa-link"></i> Tuần seeder</th>
                              <th class="text-center"><i class="fa fa-bar-chart-o"></i> Thống kê</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php  $sttw= 1;?>
                          @foreach($dmy_statictis as $dmy)
                            <tr>
                              <td><span>{{$sttw++}}</span></td>
                              <td><p>{{$dmy->date_week}}</p></td>
                              <td class="text-center"><span>{{$dmy->count_click}}</span></td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">3# Thống kê theo tháng</a>
                      </h4>
                    </div>
                    <div class="panel-collapse collapse" id="collapseThree">
                      <div class="panel-body">
                        <table class="table table-hover display table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th><i class="fa fa-link"></i> Tháng seeder</th>
                              <th class="text-center"><i class="fa fa-bar-chart-o"></i> Thống kê</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php  $sttm= 1;?>
                          @foreach($dmy_statictis as $dmy)
                            <tr>
                              <td><span>{{$sttm++}}</span></td>
                              <td><p>{{$dmy->date_month}}</p></td>
                              <td class="text-center"><span>{{$dmy->count_click}}</span></td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
        <!-- page end-->
@endsection