      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li class="sub-menu">
                      <a href="javascript();" class="
                      @if(Request::segment(2)=="statictis-seeder")
                              {{''}}
                        @else {{'active'}}
                      @endif"
                     
                      >
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard System</span>
                      </a>
                      <ul class="sub">
                          <li 
                            class="
                          @if(Request::segment(2)=="taolink")
                              {{'active'}}
                          @endif"
                          ><a href="admin/taolink"  >Rút gọn link  </a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="list-Check")
                              {{'active'}}
                          @endif"
                        ><a href="admin/list-Check">DS Chờ duyệt</a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="trackCampaign")
                              {{'active'}}
                          @endif"
                        ><a href="admin/trackCampaign">Tracking Campaign </a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="affiliate-Track")
                              {{'active'}}
                          @endif"
                        ><a href="admin/affiliate-Track">Affiliate Tracking </a></li>
                        <li
                          class="
                          @if(Request::segment(2)=="sent-messenger")
                              {{'active'}}
                          @endif"
                        ><a href="admin/sent-messenger">Gửi thông báo </a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="add-user-sedding")
                              {{'active'}}
                          @endif"
                        ><a href="admin/add-user-sedding">Thêm user seed </a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="add-category")
                              {{'active'}}
                          @endif"
                        ><a href="admin/add-category">Thêm Category </a></li>
                      </ul>
                  </li>
                 
                  <li class="sub-menu">
                      <a href="javascript:;" 
                      class="
                          @if(Request::segment(2)=="statictis-seeder")
                              {{'active'}}
                          @endif">
                          <i class="fa fa-cogs"></i>
                          <span>Thống kê seed</span>
                      </a>
                      <ul class="sub">
                        @foreach($usermenu as $us)
                          <li
                            class="
                          @if(Request::segment(3)=="$us->id")
                              {{'active'}}
                          @endif"
                          ><a href="admin/statictis-seeder/{{$us->id}}">{{$us->name}}</a></li>
                          @endforeach
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->