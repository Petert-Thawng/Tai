<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Coin;
use App\Model\Coin_transaction;
use App\Http\Controllers\Controller;
use Config;
use DB;
use Session;
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    //get api per coin symbol
    //For graph and current price
    //author Peter
    
    public function get_api(Request $request,$coin_symbol)
    {
        $image_name=$request->coin_symbol;
        
    $json_url="https://min-api.cryptocompare.com/data/histoday?&fsym=".$coin_symbol."&tsym=USD&limit=7&aggregate=1";
    $coin_symbol_res=json_decode(file_get_contents($json_url));
    $compare_coin="https://min-api.cryptocompare.com/data/price?fsym=".$coin_symbol."&tsyms=USD";
    $coin_result=json_decode(file_get_contents($compare_coin));
    $current_coin=$coin_result->USD;

      $data=$coin_symbol_res->Data;
      foreach($data as $key=>$value)
      {
        $a['date']=date('d-M-Y',$value->time);
        $a['close']=$value->close;
        $res[]=$a;
      }
      $result_coin_symbol['coin_symbol']=json_encode($res);
      return view('crypto',compact('result_coin_symbol','current_coin','image_name'));
    }

    public function go_trade(Request $request,$coin_symbol){
        $coin_name=$coin_symbol;
        $user_facebook_id=session()->get('user_profile')['facebook_id'];
        $check_result = User::where('facebook_id', $user_facebook_id)->get()->toArray();
        foreach ($check_result as $netpoints)
        {
            $net_point=$netpoints['net_points'];
        }
        $compare_coin="https://min-api.cryptocompare.com/data/price?fsym=".$coin_symbol."&tsyms=USD";
        $coin_result=json_decode(file_get_contents($compare_coin));
        $current_coin=$coin_result->USD;
        return view('trade',compact('coin_name','current_coin','net_point','user_facebook_id'));

    }

    public function account(){
        
        return view('account');
    }

    public function transaction(){
        return view('transaction');
    }
    public function buy(Request $request)
   {
     $facebook_id=$request->input('facebook_id');
     $coin_symbol=$request->input('coin_symbol');
     $price_per_coin=$request->input('price_per_coin');
     $quantity=(double)$request->input('quantity');
     $price=$request->input('price');
     $user_results=User::where('facebook_id',$facebook_id)->first()->toArray();
     $test=json_encode($user_results);
     $tests=json_decode($test);
     $net_point=$tests->net_points;
     $net_coin=$tests->net_coins;
     $id=$tests->id;
     $name=$tests->name;

    
     DB::beginTransaction();
    try{
     if($price > $net_point)
     {
        // $result['result']='';
        // $result['status']=400;
        // $result['message']="Sorry,You do not have enough points to buy.";
        // return response()->json($result);
           Session::flash('sms','Sorry,You do not have enough points to buy.');
           return redirect()->back();
     }
     else
     {
       $coin_result=Coin::where('symbol',$coin_symbol)->first()->toArray();
        $buy_coin=array($coin_result['symbol']=>$quantity);
        if(!empty($net_coin))
        {
         $primary_coin=unserialize($net_coin);
         foreach ($primary_coin as $key=>$value) {
            if($key==$coin_result['symbol'])
               {   
                 $value+=$quantity;
                 $fomart_value=rtrim(sprintf('%.8F', $value), '0');
                  $primary_coin[$key]=$fomart_value;
               }
         }
         $net_coins_array=$primary_coin;
         $serialized_net_coins= serialize($net_coins_array);  
        }        
        $this->coin=new Coin_transaction();
        $this->coin->user_id=$id;
        $this->coin->coin_id=$coin_result['id'];
        $this->coin->quantity=$request->input('quantity');
        $this->coin->price=$price;
        $this->coin->commission=0;
        $this->coin->total_cost=0;
        $this->coin->status=1;
        $this->coin->price_per_coin=$price_per_coin;
        $this->coin->created_at= $this->getDateTime24Hr();
        $coin_save_result=$this->coin->save();
      $net_point=$net_point-$price;
       $fomart_net_point=sprintf('%0.2f', $net_point);
       $update_point_result=User::where('id', $id)
             ->update(['net_coins' => $serialized_net_coins,'net_points'=>(double)$fomart_net_point]);
             $image=session()->get('user_profile')['picture']; 

            session()->put('user_profile',['name'=>$name,'picture'=>$image,'point'=>$net_point,'facebook_id'=>$facebook_id]);
     }
     }catch(\Exception $e)
    {
        
      DB::rollback();
       throw $e;
    }
      DB::commit();
      if($update_point_result)
      {
        $user_data=User::where('facebook_id',$facebook_id)->first()->toArray();
      if($user_data['net_coins']!=null)
      {
        $total_coins_array=unserialize($user_data['net_coins']);

        $i=0;
        foreach ($total_coins_array as $key => $value) {          
          $net_coin_result[$i]['coin_name']=$key;
          $net_coin_result[$i]['quantity']=$value;
          $i+=1;
        }  
        $user_data['net_coins']=$net_coin_result;
      }
    Session::flash('success','Success');
           

      }
      else
      {
           Session::flash('fail','Fail');
      }
     return redirect()->back();
   }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
