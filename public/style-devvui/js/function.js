$(document).ready(function($){
  $('.btn-like').click(function(event) {
    var flag   = $(this).data('item');
    var point  = $(this).parents('.vote').find('.point');
    var active = $(this).parents('.vote').find('.btn-like');
    var single = $(this).data('single');
    if (single.length > 0) {
      $('.btn-login-facebook').data('single', single);
      $('.btn-login-google').data('single', single);
    };
    $.ajax({
      url: BASE_URL+"like",
      type: 'POST',
      data: 'like=l'+'&flag='+flag,    
      success: function(result){
        var result = $.parseJSON(result);
        if (result.data.active == 1) {
          active.addClass('btn-like-active')
        }else{
          active.removeClass('btn-like-active');
        };
        point.html(result.data.like);
      }
    });
  });//jQuery like and unlike

  $('.loading-click').click(function(event) {
    if($("input#txtTitle").val() == '' || $("input#fileUpload").val() == '') {
      $(".msg-submit").html('<div class="alert alert-danger" role="alert"><strong>Bạn cần phải chia sẻ điều gì đó !</strong></div>');
    }else{
      $(".msg-submit").html('');
      $.ajax({
        url: BASE_URL+'gop-anh',
        type: 'POST',
        data: new FormData($('#form_gopanh')[0]), 
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $('.close').click();
        },
        success: function(result){
          var result = $.parseJSON(result);
          if(result.status == 'ERROR'){
            $(".loading").html('<div class="alert alert-danger alert-dismissible alert-style" role="alert"><a class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a><strong>'+result.message+'</strong></div>');
            $('.loading').fadeIn(200);
          }else if(result.status == 'SUCCESS'){
            $(".loading").html('<div class="alert alert-success alert-dismissible alert-style" role="alert"><a class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a><strong>'+result.message+'</strong></div>');
            $('.loading').fadeIn(400).fadeOut(3000);
            $('#form_gopanh')[0].reset();
          }
        }
      });
    }
  });//jQuery loading

  $('.loading').click(function(event) {
    $('.loading').fadeOut(300);
  });//jQuery close loading

  $('.btn-create-title').click(function(event) {
    var linkCreateTitle = $(this).data('lik');
    if(linkCreateTitle.length > 0){
      $('.btn-login-facebook').data('lik', linkCreateTitle);
      $('.btn-login-google').data('lik', linkCreateTitle);
    };
  });
  //jQuery btn create title
  $('body').on('click','.btn-login-facebook',function (e) {
    var single          = $(this).data('single');
    var linkCreateTitle = $(this).data('lik');
    e.preventDefault();
    FB.login(function (response) {
      if (response.authResponse){
      	FB.api('/me?fields=id,name,email', function (response) {
      	  if (response.email == null) {
      	  	alert('Sorry email not found.Login failed !');
      	  	return false;
      	  }
      	  $.ajax({
      	  	type: "POST",data: "email="+response.email+"&response="+JSON.stringify(response),url: BASE_URL+"login-facebook",
      	  	beforeSend: function () {
      	  	  $('.close').click();
      	  	},
      	  	success: function () {
              if (single.length > 0) {
                window.location.href = single;
              }else if(linkCreateTitle.length > 0){
                window.location.href = linkCreateTitle;
              }else{
                window.location.href = CUR;
              }
      	  	}
      	  });
      	});
      }else{
      	console.log('User cancelled login or did not fully authorize.');
      }
    }, {scope: 'email'});
  });//jQuery login facebook 
  $('.btn-login-google').click(function(event) {    
    var single = $('.btn-login-google').data('single'), linkCreateTitle = $('.btn-login-google').data('lik');
    initiateSignIn();
  });
  $(function(){
    $('.back-top a').click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 500);
      return false;
    });
  });// jQuery back top
});
//jQueyr login google
function initiateSignIn(){
  var params = {
    'clientid': '72507150554-vc1ie3eme3kf4c66obm519c7037htkkm.apps.googleusercontent.com',
    'cookiepolicy': BASE_URL,
    'callback': 'onSignInCallback',
    'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
    'requestvisibleactions': 'http://schemas.google.com/AddActivity',
  };
  gapi.auth.signIn(params);
}
function onSignInCallback(resp) {
  gapi.client.load('plus', 'v1', apiClientLoaded);
  gapi.client.load('oauth2', 'v2', apiClientLoaded2);
}
function apiClientLoaded() {
  gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
}
function apiClientLoaded2() {
  gapi.client.oauth2.userinfo.get().execute(handleEmailResponse);
}
function handleEmailResponse(resp) {
  var email, avatar;
  var arAvatar        = resp.image.url.split('?sz=');
  avatar = arAvatar[0] + '?sz=200';
  for (var i = 0; i < resp.emails.length; i++) {
    if (resp.emails[i].type === 'account') {
      email = resp.emails[i].value;
    }
  }
  console.log(resp);
  $.ajax({
    url: BASE_URL+"login-google",
    type: "POST",
    data: "email=" + email + "&response=" + JSON.parse(JSON.stringify(resp)),
    beforeSend: function (){
      $('.close').click();
    },
    success: function(){
      window.location.href = BASE_URL;
      //alert(JSON.stringify(resp));
      //alert(single);
      //alert(linkCreateTitle);
    }
  });
}// End jQuery login google