<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset(' ')}}" >
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="frontend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="frontend/css/shop-homepage.css" rel="stylesheet">
    <link href="frontend/css/my.css" rel="stylesheet">
    @yield('css')
</head>
<body>

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
          <a href="lienhe">Contact</a>
        </li>
      </ul>
     <ul class="nav navbar-nav pull-right">
     @if(!Auth::user())
       <li>
        <a href="dangky">Sign up</a>
      </li>
      <li>
        <a href="dangnhap">Sign in</a>
      </li>
      @else
      <li>
       <a>
        <span class ="glyphicon glyphicon-user"></span>
        {{Auth::user()->name}}
      </a>
    </li>

    <li>
     <a href="dangxuat">Đăng xuất</a>
   </li>
   @endif
 </ul>
</div>



<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">

                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title" style="margin:50px;font-weight: bold;color: red">Login to use.........please!!</h3>
                  </div>
                  <div class="panel-body">
                        <form class="form-horizontal">

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">Sign in</button>
                          <a href="#"><button type="button" class="btn btn-success">Sign up</button></a>
                          </div>
                      </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
</html>
