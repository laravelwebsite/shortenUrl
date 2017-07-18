      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li class="sub-menu">
                      <a href="javascript();" class="active" >
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard System</span>
                      </a>
                      <ul class="sub">
                          <li 
                            class="
                          @if(Request::segment(2)=="taolink")
                              {{'active'}}
                          @endif"
                          ><a href="subadmin/taolink"  >Rút gọn link  </a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="statictis")
                              {{'active'}}
                          @endif"
                        ><a href="subadmin/statictis">Thống kê</a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="affiliateTracking")
                              {{'active'}}
                          @endif"
                        ><a href="subadmin/affiliateTracking">Affiliate Tracking</a></li>
                         <li
                            class="
                          @if(Request::segment(2)=="trackCampaign")
                              {{'active'}}
                          @endif"
                         ><a href="subadmin/trackCampaign">Tracking Campaign</a></li>
                          <li 
                            class="
                          @if(Request::segment(2)=="affiliate-Track")
                              {{'active'}}
                          @endif"
                          ><a href="subadmin/affiliate-Track">Affiliate Tracking Manager</a></li>
                        <li 
                            class="
                          @if(Request::segment(2)=="messengers")
                              {{'active'}}
                          @endif"
                        ><a href="subadmin/messengers">Thông báo</a></li>
                       
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->