@extends('layouts.app')

@section('content')
<section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-sm-12">
                    <!--tab start-->
                      <ul class="nav nav-pills">
                        <li class="nav-item" style="border:2px solid #222528;">
                          <a class="nav-link active" data-target="#carousel" data-slide-to="0" href="#">COIL TRANSACTION </a>
                        </li>
                        <li class="nav-item" style="border:2px solid #222528;">
                          <a class="nav-link" data-target="#carousel" data-slide-to="1" href="#">POINT TRANSACTION</a>
                        </li>
                      </ul>
                    <!--tab end-->
                  </div>
              </div>
                <div class="row">
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
                              <div class="container" style="padding:30px; font-size:20px; text-align:center;">
                                <div class="row">
                                  <div class="col-sm-offset-2 col-sm-8">
                                    <table class="table"> 
                                              <tr>
                                                  <td>You received daily reward</td>
                                                  <td>16/03/2018</td>
                                                  <td>+400 Points</td>
                                                  <td>10:20 AM</td>
                                              </tr>
                                              <tr>
                                                  <td>You received daily reward</td>
                                                  <td>16/03/2018</td>
                                                  <td>+400 Points</td>
                                                  <td>10:20 AM</td>
                                              </tr>
                                              <tr>
                                                  <td>You received daily reward</td>
                                                  <td>16/03/2018</td>
                                                  <td>+400 Points</td>
                                                  <td>10:20 AM</td>
                                              </tr>
                                      </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="slide-content">
                            <video poster="http://192.241.175.50/videos/boston.jpg" webkit-playsinline id="bgvid" loop>
                              <source src="http://192.241.175.50/videos/boston.webm" type="video/webm">
                              <source src="http://192.241.175.50/videos/boston.mp4" type="video/mp4">
                            </video>
                            <div class="slide-overlay door">
                              <div class="container" style="padding:30px; font-size:16px; text-align:center;">
                                <div class="row">
                                  <div class="col-sm-offset-2 col-sm-8">
                                     <table class="table"> 
                                              <tr>
                                                  <td>You bought 1.5 Bitcoin</td>
                                                  <td>16/03/2018</td>
                                                  <td>-1245.50 Points</td>
                                                  <td>10:20 AM</td>
                                              </tr>
                                              <tr>
                                                  <td>You bought 1.5 Bitcoin</td>
                                                  <td>16/03/2018</td>
                                                  <td>-1245.50 Points</td>
                                                  <td>10:20 AM</td>
                                              </tr>
                                              <tr>
                                                  <td>You bought 1.5 Bitcoin</td>
                                                  <td>16/03/2018</td>
                                                  <td>-1245.50 Points</td>
                                                  <td>10:20 AM</td>
                                              </tr>
                                      </table>
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
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection
