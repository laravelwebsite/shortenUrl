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
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-envelope"></i>
                          <span>Email</span>
                      </a>
                      <ul class="sub">
                          <li><a  >Inbox</a></li>
                          <li><a  >Inbox Details</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Thống kê seed</span>
                      </a>
                      <ul class="sub">
                          <li><a >Luu vi </a></li>
                          <li><a >phi hung</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>User</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="admin/user/list">List User</a></li>
                          <li><a  href="admin/user/add">Add User</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Link</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="admin/link/list">List Link</a></li>
                          <li><a  href="admin/link/add">Add Link</a></li>
                      </ul>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->