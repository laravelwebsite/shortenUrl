<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Make Short Link</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="#">About</a>
        </li>
        <li>
          <a href="#">Contact</a>
        </li>
      </ul>
     <ul class="nav navbar-nav pull-right">
     @if(!Auth::user())
       <li>
        <a href="dangky">Sign up</a>
      </li>
      <li>
        <a href="/">Sign in</a>
      </li>
      @else
      <li>
       <a>
        <span class ="glyphicon glyphicon-user"></span>
        {{Auth::user()->name}}
      </a>
    </li>
      <li>
     <a href="trangchu/list">List your link</a>
   </li>
    <li>
     <a href="dangxuat">Logout</a>
   </li>
   @endif
 </ul>
</div>



<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>