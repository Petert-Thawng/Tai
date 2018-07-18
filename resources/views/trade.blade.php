@extends('layouts.app')

@section('content')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
                  
                    <div class="row mtbox">
                    <!-- BTC -->
                      <a href="{{url('show_api/BTC')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px 5px 0px 50px; ">
                          <div class="box1">
                              <img src="{{url('default_images/btc.png')}}">
                              <h3>BTC</h3>
                            </div>
                        </div>
                      </a>

                      <!-- ETH -->
                      <a href="{{url('show_api/ETH')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px; ">
                          <div class="box1">
                            <img src="{{url('default_images/eth.svg')}}">
                            <h3>ETH</h3>
                          </div>
                        </div>
                      </a>

                      <!-- XRP -->
                      <a href="{{url('show_api/XRP')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px; ">
                          <div class="box1">
                            <img src="{{url('default_images/xrp.png')}}">
                            <h3>XRP</h3>
                          </div>
                        </div>
                      </a>

                      <!-- BCH -->
                      <a href="{{url('show_api/BCH')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px;">
                          <div class="box1">
                            <img src="{{url('default_images/bch.png')}}">
                            <h3>BCH</h3>
                          </div>
                        </div>
                      </a>

                      <!-- ADA -->
                      <a href="{{url('show_api/ADA')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px; ">
                          <div class="box1">
                            <img src="{{url('default_images/ada.png')}}">
                            <h3>ADA</h3>
                          </div>
                        </div>
                      </a>

                      <!-- XLM -->
                      <a href="{{url('show_api/XLM')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px;">
                          <div class="box1">
                            <img src="{{url('default_images/xlm.png')}}">
                            <h3>XLM</h3>
                          </div>
                        </div>
                      </a>

                      <!-- LTC -->
                      <a href="{{url('show_api/LTC')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px; ">
                          <div class="box1">
                            <img src="{{url('default_images/ltc.png')}}">
                            <h3>LTC</h3>
                          </div>
                        </div>
                      </a>

                      <!-- NEO -->
                      <a href="{{url('show_api/NEO')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px; ">
                          <div class="box1">
                            <img src="{{url('default_images/neo.png')}}">
                            <h3>NEO</h3>
                          </div>
                        </div>
                      </a>

                      <!-- EOS -->
                      <a href="{{url('show_api/EOS')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px;">
                          <div class="box1">
                            <img src="{{url('default_images/eos.png')}}">
                            <h3>EOS</h3>
                          </div>
                        </div>
                      </a>

                      <!-- XEM -->
                      <a href="{{url('show_api/XEM')}}">
                        <div class="col-md-1 col-sm-1 box0" style="background-color:#222528; box-shadow:5px 5px 5px black; margin:5px; ">
                          <div class="box1">
                            <img src="{{url('default_images/xem.png')}}">
                            <h3>XEM</h3>
                          </div>
                        </div>
                      </a>
                    </div><!-- /row mt --> 
                  </div><!-- /col-lg-19 END SECTION MIDDLE -->
                </div>

                <div class="row" style="margin:0px 30px 20px;">
                    <div class="col-sm-12" style="background-color:#222528;">
                        <h3 style="color:#95c623; font-family:'ruda';">Your Balanced - <span style="color:##e55812;">{{$net_point}}</span></h3>
                    </div>
                </div>
              <!--carousel start-->
              <div class="row">
                  <div class="col-sm-12" style="margin-left:35px; font-family:'ruda';">
                    <!--tab start-->
                      <ul class="nav nav-pills">
                        <li class="nav-item" style="border:2px solid #222528;">
                          <a class="nav-link acti ve" data-target="#carousel" data-slide-to="0" href="#">BUY</a>
                        </li>
                        <li class="nav-item" style="border:2px solid #222528;">
                          <a class="nav-link" data-target="#carousel" data-slide-to="1" href="#">SELL</a>
                        </li>
                      </ul>
                    <!--tab end-->
                  </div>
              </div>
                
                <div class="row" style="margin-left:20px; margin-right:20px;">
                  <div class="col-sm-12">
                    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false" style="background-color:#222528;">
                      <!-- Carousel items -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <div class="slide-content">
                            <video poster="http://192.241.175.50/videos/london.jpg" webkit-playsinline id="bgvid" loop>
                              <source src="http://192.241.175.50/videos/london.webm" type="video/webm">
                              <source src="http://192.241.175.50/videos/london.mp4" type="video/mp4">
                            </video>

                            <div class="slide-overlay door">
                              <div class="container" style="padding:50px 0px 50px; text-align:center;  font-family:'ruda';">
                                <div class="row">
                                   <form method="POST" action="{{url('buy')}}">
                                     {{ csrf_field() }}

                                  <div class="col-sm-offset-1 col-sm-10">
                                    <div class="col-sm-3" style="border-right:2px solid #3d3d3d;"><img src="{{url('default_images/'.$coin_name.'.png')}}" style="height:50px; width:50px; margin-bottom:15px;"><p style="font-size:20px;"> {{$coin_name}}</p></div>
                                    <div class="col-sm-3" style="border-right:2px solid #3d3d3d;"><p style="font-size:20px;">CURRENT PRICE</p><hr/><p style="font-size:20px;"> ${{$current_coin}}</p></div>
                                   
                                    <div class="col-sm-2" style="border-right:2px solid #3d3d3d;"><p style="font-size:20px;">QUALITY</p><hr/><p style="font-size:20px;"> 
                                    <input id="colorful" class="form-control coin" type="number" name="quantity" value="1" min="1" max="30" />
                                    <input type="hidden" name="price_per_coin" value="{{$current_coin}}">
                                    <input type="hidden" name="coin_symbol" value="{{$coin_name}}">
                                    <input type="hidden" name="facebook_id" value="{{$user_facebook_id}}">

                                    </p></div>
                                    <div class="col-sm-2" style="border-right:2px solid #3d3d3d;"><p style="font-size:20px;">TOTAL</p><hr/><p style="font-size:20px;"> 

                                      <input type="text" style="background-color: transparent; color: white; border:0px;" class="form-control total" name="price" readonly>

                                    </p></div>
                                    <div class="col-sm-2"><button class="btn btn-info" style="background-color:#428BCA; width:80px; margin-bottom:30px;" type="submit">BUY</button><br/><button class="btn btn-danger" style="background-color:#E55812; width:80px;">CANCEL</button></div>
                                  </div>
                                </form>


                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <p id="alert"></p><!--alert with message-->
                        @if(Session()->has('sms'))
<p class="alert alert-warning">{{Session::get('sms')}}</p>
@endif
               @if(Session()->has('success'))
<p class="alert alert-info">{{Session::get('success')}}</p>
@endif
                        <div class="item">
                          <div class="slide-content">
                            <video poster="http://192.241.175.50/videos/boston.jpg" webkit-playsinline id="bgvid" loop>
                              <source src="http://192.241.175.50/videos/boston.webm" type="video/webm">
                              <source src="http://192.241.175.50/videos/boston.mp4" type="video/mp4">
                            </video>
                            <div class="slide-overlay door">
                              <div class="container" style="padding:50px 0px 50px; text-align:center; font-family:'ruda';">
                                <div class="row">
                                  <div class="col-sm-offset-1 col-sm-10">
                                    <div class="col-sm-3" style="border-right:2px solid #3d3d3d;"><img src="{{url('default_images/btc.png')}}" style="height:50px; width:50px; margin-bottom:15px;"><p style="font-size:20px;"> BTC</p></div>
                                    <div class="col-sm-3" style="border-right:2px solid #3d3d3d;"><p style="font-size:20px;">CURRENT PRICE</p><hr/><p style="font-size:20px;"> $ 1239.30</p></div>
                                    <div class="col-sm-2" style="border-right:2px solid #3d3d3d;"><p style="font-size:20px;">QUALITY</p><hr/><p style="font-size:20px;"> $ 1239.30</p></div>
                                    <div class="col-sm-2" style="border-right:2px solid #3d3d3d;"><p style="font-size:20px;">TOTAL</p><hr/><p style="font-size:20px;"> $ 1239.30</p></div>
                                    <div class="col-sm-2"><button class="btn btn-info" style="background-color:#428BCA; width:80px; margin-bottom:30px;">SELL</button><br/><button class="btn btn-danger" style="background-color:#E55812; width:80px;">CANCEL</button></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              <!--carousel end-->
          </section>
      </section>

@endsection
@section('script')
<script>
// Remember set you events before call bootstrapSwitch or they will fire after bootstrapSwitch's events
$("[name='checkbox2']").change(function() {
  if(!confirm('Do you wanna cancel me!')) {
    this.checked = true;
  }
});

$('#colorful').bootstrapNumber({
  upClass: 'success',
  downClass: 'danger'
});
</script>
 <script src="{{ URL::asset('public/js/jquery.numeric.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function(){
    
      $(".coin").keyup(function(){
       var amount= {{$current_coin}} ;
       var result=$(this).val() * amount;
       $( ".total" ).val(result);
       var point={{$net_point}};
       if(result>point)
       {
        document.getElementById("alert").innerHTML = "You don't have enough coin";
       }
       
    });
});
</script>
@endsection

