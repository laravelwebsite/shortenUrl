<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shorten URL</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset(' ')}}" >
    <!-- Bootstrap CSS -->
    <link href="css-js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css-js/style.css">
    <script src="css-js/jquery.min.js"></script>
    <script type="text/javascript" src="css-js/bootstrap-filestyle.js"></script>
    <?php 
      if(isset($inforurl->title) && isset($inforurl->description) && isset($inforurl->fileUpload_name)){
          echo '<meta property="og:image" content="'.'http://'.$_SERVER['SERVER_NAME'].'images/'.$inforurl->fileUpload_name.'" />';
          echo '<meta property="og:url" content="'.'http://'.$_SERVER['SERVER_NAME'].$inforurl->shortcut_url.'" />';
          echo '<meta property="og:type" content="website" />';
          echo '<meta property="og:title" content="'.htmlentities($inforurl->title).'" />';
          echo '<meta property="og:description" content="'.htmlentities($inforurl->description).'" />';
          echo '<meta property="fb:app_id" content="848400658529425" />';
          echo '<script>jQuery(document).ready(function($){ window.location.href = "'.$inforurl->redirect.'";});</script>';
        }
        else
        {
          header("Location: ".$inforurl->redirect);
        }

      
      function check_link($link){
        //global $database->shortcut_url;
        $cursor = $database->shortcut_url->find(array('redirect' => $link));
        foreach ($cursor as $document) {
          $redirect = $document["redirect"];
          if ($redirect  == $link) {
            $shortcut_url = $document['shortcut_url'];
            return true;
            break;
          }
        }
      }
      function get_params($index){
        $uri = $_SERVER["REQUEST_URI"];
        $tmp = explode('/', $uri);
        if(isset($tmp[$index])){
          return $tmp[$index];
        }
        return null;
      }
    ?>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '176808162672464',
          xfbml      : true,
          version    : 'v2.5'
        });
      };
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- jQuery -->
    <script src="css-js/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="css-js/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>