<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/flatlab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:43:56 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>Login Admin</title>
    
    <base href="{{asset(' ')}}" >
    <!-- Bootstrap core CSS -->
    <link href="admin2/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin2/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="admin2/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="admin2/css/style.css" rel="stylesheet">
    <link href="admin2/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" role="form" action="login" method="POST">
      @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong>There were some problems with your input! <br><br>
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul> 
                            </div>
                            @endif

                            @if(session('thongbao'))
                            <div class="alert alert-danger">
                                <strong>{{session('thongbao')}}</strong>
                            </div>
                            @endif
         <input type="hidden" name="_token" value="{{csrf_token()}}">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required>
            </div>
            <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
            <p>or you can sign in via social network</p>
            <div class="login-social-link">
                <a href="index.html" class="facebook">
                    <i class="fa fa-facebook"></i>
                    Facebook
                </a>
                <a href="index.html" class="twitter">
                    <i class="fa fa-twitter"></i>
                    Twitter
                </a>
            </div>
            <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="email" name="email1" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>
    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="admin2/js/jquery.js"></script>
    <script src="admin2/js/bootstrap.min.js"></script>


  </body>

<!-- Mirrored from thevectorlab.net/flatlab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:43:57 GMT -->
</html>




