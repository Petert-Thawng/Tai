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
                    <!-- graph start -->
                    <div class="row mtbox">
                      <div class="col-md-10 col-sm-10 col-md-offset-1"  style="text-align:right; background-color:#222528;  box-shadow:5px 5px 5px black">
                          <div class="row">
                            <div class="col-sm-12" style="margin-top:20px;">
                              <div class="col-sm-4" style="background-color:#ffffff; color:#f2f2f2; font-size:16px; box-shadow:5px 5px 5px black; font-weight:bold; padding:5px; text-align:left; z-index:1; margin-bottom:-30px;">
                                <div class="col-sm-4">
                                  <img src="{{url('default_images/'. $image_name.'.png')}}" style="height:70px; width:70px;">
                                </div> 
                                <div class="col-sm-8" style="color:#222528; text-align:center;">
                                  <p style="border-bottom:1px solid #222528;">Current Price</p>
                                  <p>${{ $current_coin}}</p>
                                </div>
                              </div>
                              <div class="col-sm-8" style="align:right;"><a href="{{url('trade/'.$image_name)}}" class="btn btn-primary" style="background-color:#428BCA; box-shadow:5px 5px 5px black; width:80px;">Trade</a></div> <!--image_name=coin_symbol-->
                            </div>
                          </div>
                          
                          <div class="box1" id="coin_symbol" style="height:350px;"></div>
                          </div>
                    </div><!-- /row mt --> 
                    <!-- graph end-->   
                  </div>
              </div><!-- /col-lg-9 END SECTION MIDDLE -->
              
          </section>
      </section>

@endsection

@section('script')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Month', 'Range range'],
      <?php 

      $json_data= json_decode($result_coin_symbol['coin_symbol']);
      
    
      foreach ($json_data as $key => $value) {
      //   foreach ($value as $api => $data) {
        
        
      //   echo "['".$data->btc['date']."',".$data->btc['close']."],";
      // }
        echo "['".$value->date."',".$value->close."],";
      }
      ?>
      ]);

    var options = {
      backgroundColor: '#222528',
      legendTextStyle: { color: '#FFF' },

      hAxis: {
          title: 'Sample',
          textStyle:{color: '#f2f2f2'},
          titleTextStyle: { color: '#FFF' },
        },

        vAxis: {
          title: 'Sample',
          textStyle:{color: '#f2f2f2'},
          titleTextStyle: { color: '#FFF' },
          baselineColor: '#3d3d3d',
         gridlineColor: '#3d3d3d',
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('coin_symbol'));

    chart.draw(data, options);
  }
  
  
</script>

@endsection