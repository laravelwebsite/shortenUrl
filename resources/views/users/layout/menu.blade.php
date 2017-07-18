      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li class="sub-menu" >
                     <a href="javascript();" class="active"><i class="fa fa-dashboard"></i><span>Dashboard </span></a>
                      <ul class="sub">
                          <li 
                            class="
                          @if(Request::segment(2)=="taolink")
                              {{'active'}}
                          @endif"
                          ><a href="user/taolink" >Rút gọn link  </a></li>
                        <li  
                          class="
                          @if(Request::segment(2)=="statictis")
                              {{'active'}}
                          @endif"
                        ><a href="user/statictis">Thống kê</a></li>
                        <li 
                          class="
                          @if(Request::segment(2)=="affiliateTracking")
                              {{'active'}}
                          @endif"
                        ><a href="user/affiliateTracking">Affiliate Tracking</a></li>
                        <li 
                          class="
                          @if(Request::segment(2)=="messengers")
                              {{'active'}}
                          @endif"
                        ><a href="user/messengers">Thông báo </a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->