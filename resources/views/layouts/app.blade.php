<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DASHGUM - FREE Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!--external css-->
    <link href="{{ asset('font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('js/gritter/css/jquery.gritter.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('lineicons/style.css') }}" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">

    <!-- My Styles for this template -->
    <link href="{{ asset('css/snip.css') }}" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

</head>
<body style="background-color:#3d3d3d;">
     <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg" style="background-color:#95c623; box-shadow:3px 3px 3px black">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="#" class="logo"><img src="{{ url('default_images/fc.png') }}" style="width:30px; height:30px;"><b>Fantasy Crypto</b></a>
            <!--logo end-->
            <!-- <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" style="backgrond-color:#222528;" href="">Logout</a></li>
              </ul>
            </div> -->
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse " style="background-color:#222528; box-shadow:5px 0px 5px black;">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
            
                  <p class="centered">

              <a href="{{ url('account/') }}">
              
              


              <img src="{{ Session::get('user_profile') ['picture']['data']['url']}}" class="img-circle" width="60"></a></p>
                  <h4 class="centered" style="color:#95c623">{{ Session::get('user_profile') ['name']}}</h4>
                  <h4 class="centered" style="color:#e55812;">Points - {{ Session::get('user_profile') ['point']}} </h4>
                
                  <hr style="border:1px solid #95c623; margin:0px 10px;" />
                    
                  <li class="mt">
                      <a class="active" href="{{url('show_api/BTC')}}">
                          <i class="fab fa-bitcoin" style="font-size:25px;"></i>
                          <span style="font-size:20px;">Crypto</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fas fa-gift" style="font-size:25px;"></i>
                          <span style="font-size:20px;">Reward</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fas fa-list-ol" style="font-size:25px;"></i>
                          <span style="font-size:20px;">Leader Board</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fas fa-history" style="font-size:25px;"></i>
                          <span style="font-size:20px;">Transaction Log</span>
                      </a>
                  </li>

                  <hr style="border:1px solid #95c623; margin:0px 10px;" />

                  <li class="sub-menu">
                      <a href="{{url('logout')}}" >
                          <i class="fas fa-sign-out-alt"></i>
                          <span style="font-size:16px;">Logout</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fas fa-info-circle" style="font-size:25px;"></i>
                          <span style="font-size:20px;">About</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
  </section>


        @yield('content')
        <!--footer start-->
          <!-- <footer class="site-footer">
              <div class="text-center">
                  2014 - Alvarez.is
                  <a href="index.html#" class="go-top">
                      <i class="fa fa-angle-up"></i>
                  </a>
              </div>
          </footer> -->
        <!--footer end-->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-1.8.3.min.js') }}">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script class="include" type="text/javascript" src="{{ asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-1y.sparkline.js') }}"></script>
    

    <!--common script for all pages-->
    <script src="{{ asset('js/common-scripts.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('js/gritter/js/jquery.gritter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/gritter-conf.js') }}"></script>
    <script src="{{asset('js/bootstrap-number-input.js')}}" ></script>  
      @yield('script')
    
    <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Dashgum!',
            // (string | mandatory) the text inside the notification
            text:,
            // (string | optional) the image to display on the left
            image: 'assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
    </script>
    
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

</body>
</html>
