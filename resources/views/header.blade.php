  <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
      <a href="admin/user/list" class="logo"><!-- Control<span> Site</span> --><img src="/style-shorten/img/logo_new.png" alt=""></a>
      <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="admin2/img/avatar1_small.jpg">
                            <span class="username">{{Auth::user()->name}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href=""><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href=""><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href=""><i class="fa fa-bell-o"></i> Notification</a></li>
                            <li><a href="logout"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <li class="sb-toggle-right">
                        <i class="fa  fa-align-right"></i>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->