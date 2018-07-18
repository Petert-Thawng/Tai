<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style type="text/css">
      body{
        background-color: #3d3d3d;
      }
      #letter
      {
        color: white;
        font-size: 4em;
        margin-left: 20px;
      }
      #facebook_button
      {
        width: ;
      }
      .image{
        margin-top: 30px;
        width: 200px;
        height: 200px;
        margin-left: 100px;
      }
    </style>
</head>
<body>

<div class="row">
<div class="col-md-4"></div>

<div class="col-md-4">
<div class="row">
<div class="col-md-12"><img src="{{ url('default_images/fc.png') }}" class="img-rounded image"></div>
<div class="col-md-12" id="letter">Fantasy Crypto</style></div>
<div class="col-md-12">
<!-- 
<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();" scope="public_profile,email">
</div> -->
<div class="fb-login-button" data-width="400" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();" id="letter" scope="public_profile,email"></div>
</div>


</div><!-- inner row -->
</div><!-- 2nd col-md-4 -->

<div class="col-md-4"></div>

</div> <!-- main row -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script>

  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
      testAPI();
    } else {
      console.log("not connected");
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2034296660167236',
      cookie     : true,  
      xfbml      : true,  
      version    : 'v2.8' 
    });

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{fields: 'id,name,email,picture'}, function(response) {
      console.log(response);
        send_data(response.id,response.name,response.email,response.picture);
        });
  
  function send_data(id,name,email,picture)
  {
    $.ajax({
  
      type: "POST",
      url: "{{url("facebook_login")}}",
      data: {'id':id,'name':name,'email': email,'picture':picture,  "_token": "{{ csrf_token() }}"},
      dataType: "json",
      success: function(data){
         // $("what_ever_you_want_to_replace").html(data.view);
          // window.location.replace('account');
           // alert(data);
            window.location.replace("{{url('person_profile')}}");

      }
    });
    

  }
}

</script>
</body>
</html>


