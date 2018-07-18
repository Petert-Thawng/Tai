@extends('layouts.app')

@section('content')

<section id="main-content">
  <section class="wrapper"> 
    <div class="row">
      <div class="col-sm-offset-1 col-sm-10 main-chart">
       <div class="  custab" style="background-color:#222528;  margin-top:30px;">
            <div style="color:#95C623; padding:20px; border-bottom:2px solid #95C623; text-align:left;">
              <span class="h3">Your Balance - $ 23328.30</span> 
            </div>
          <table class="table" style="font-size:20px;">
          <thead style="background-color:#222528; color:#f2f2f2;">
              <tr>
                  <th>No.</th>
                  <th>Cryptos</th>
                  <th>Quantity</th>
                  <th>Points</th>
                  <th class="text-center">Trade</th>
              </tr>
          </thead>
                  <tr>
                      <td>1</td>
                      <td>Bitcoin</td>
                      <td>2.5</td>
                      <td>1234.90</td>
                      <td class="text-center"><a class='btn' href="#" style="background-color:#428BCA; color:white;">BUY</a> <a href="#" class="btn" style="background-color:#E55812; color:white;">SELL</a></td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>Bitcoin</td>
                      <td>2.5</td>
                      <td>1234.90</td>
                      <td class="text-center"><a class='btn' href="#" style="background-color:#428BCA; color:white;">BUY</a> <a href="#" class="btn" style="background-color:#E55812; color:white;">SELL</a></td>
                  </tr>
                  <tr>
                      <td>3</td>
                      <td>Bitcoin</td>
                      <td>2.5</td>
                      <td>1234.90</td>
                      <td class="text-center"><a class='btn' href="#" style="background-color:#428BCA; color:white;">BUY</a> <a href="#" class="btn" style="background-color:#E55812; color:white;">SELL</a></td>
                  </tr>
          </table>
        </div>
      </div>
    </div>
  </section>
</section>

@endsection

@section('script')
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection
