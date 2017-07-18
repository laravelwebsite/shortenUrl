<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:42:50 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
      
    <title>@yield('title')</title>
    <base href="{{asset(' ')}}" >
   <link href="style-shorten/css/bootstrap.min.css" rel="stylesheet">
    <link href="style-shorten/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="style-shorten/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
     
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="style-shorten/assets/jquery-multi-select/css/multi-select.css" />

    <!--right slidebar-->
    <link href="style-shorten/css/slidebars.css" rel="stylesheet">

    <!--  summernote -->
    <link href="style-shorten/assets/summernote/dist/summernote.css" rel="stylesheet">
       @yield('header')
    <!-- Custom styles for this template -->
    <link href="style-shorten/css/style.css" rel="stylesheet">
    <link href="style-shorten/css/style-responsive.css" rel="stylesheet" />
    <script type="text/javascript" src="style-shorten/assets/ckeditor/ckeditor.js"></script>
  </head>

  <body>

  <section id="container" >
    @include('admin.layout.header')
    @include('users.layout.menu')
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              @yield('content')
          </section>
      </section>
      <!--main content end-->

      @include('admin.layout.slidebar')

      @include('admin.layout.footer')
  </section>

   
@yield('script')
  </body>

<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:43:32 GMT -->
</html>
