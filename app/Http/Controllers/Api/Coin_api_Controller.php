<?php

namespace App\Http\Controllers\Api;
use App\Model\Coin;
use App\Model\User;
use App\Model\Coin_transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use DB;
class Coin_api_Controller extends Controller
{

   public function get_coin_list()
   {
     $coin_result=Coin::get()->toArray();
     $result['result']=$coin_result;
     $result['status']=200;
     $result['message']="Success";
     return response()->json($result);
   }
   public function buy(Request $request)
   {
     $facebook_id=$request->input('facebook_id');
     $coin_symbol=$request->input('coin_symbol');
     $price_per_coin=$request->input('price_per_coin');
     $quantity=(double)$request->input('quantity');
     $price=$request->input('price');
     $user_result=User::where('facebook_id',$facebook_id)->first()->toArray();
     $net_coin=$user_result['net_coins'];
     $net_point=$user_result['net_points'];
     DB::beginTransaction();
    try{
     if($price > $net_point)
     {
        $result['result']='';
        $result['status']=400;
        $result['message']="Sorry,You do not have enough points to buy.";
        return response()->json($result);
     }
     else
     {
       $coin_result=Coin::where('symbol',$coin_symbol)->first()->toArray();
        $buy_coin=array($coin_result['symbol']=>$quantity);
        if(!empty($user_result['net_coins']))
        {
         $primary_coin=unserialize($user_result['net_coins']);
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
        $this->coin->user_id=$user_result['id'];
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
       $update_point_result=User::where('id', $user_result['id'])
             ->update(['net_coins' => $serialized_net_coins,'net_points'=>(double)$fomart_net_point]); 
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
        $message="Success";
        $status=200;
      }
      else
      {
        $user_data='';
        $message="Failed in update coin.";
        $status=400;
      }
     $result['result']=$user_data;
     $result['status']=$status;
     $result['message']=$message;
     return response()->json($result);
   }

   public function sell(Request $request)
   {
     $facebook_id=$request->input('facebook_id');
     $coin_symbol=$request->input('coin_symbol');
     $price_per_coin=$request->input('price_per_coin');
     $quantity=(double)$request->input('quantity');

     $price=$request->input('price');

     $user_result=User::where('facebook_id',$facebook_id)->first()->toArray();
     $net_coin=$user_result['net_coins'];
     $net_point=$user_result['net_points'];


     $coin_result=Coin::where('symbol',$coin_symbol)->first()->toArray();
     $total_coins_array=unserialize($user_result['net_coins']);
     foreach ($total_coins_array as $key=>$value) {

        if($key==$coin_result['symbol'])
           {   
              $holding_coin_symbol=$key;
              $holding_coin_quantity=$value;
           }
             
      }
      if($quantity > $holding_coin_quantity)
      {
       $result['result']='';
       $result['status']=400;
       $result['message']="You don't have enough coin to sell.";
       return response()->json($result); 
      }
      else
      {
          DB::beginTransaction();
        try{

        $this->coin=new Coin_transaction();
        $this->coin->user_id=$user_result['id'];
        $this->coin->coin_id=$coin_result['id'];
        $this->coin->quantity=$quantity;
        $this->coin->price=$price;
        $this->coin->commission=0;
        $this->coin->total_cost=0;
        $this->coin->status=0;
        $this->coin->price_per_coin=$price_per_coin;
        $this->coin->created_at= $this->getDateTime24Hr();
        $coin_save_result=$this->coin->save();

        $holding_coin_quantity-=$quantity;

        $fomart_value=rtrim(sprintf('%.8F', $holding_coin_quantity), '0');
        if($fomart_value=="0.")
        {
          $fomart_value="0";
        }
        $sell_coin_array=array($holding_coin_symbol=>$fomart_value);
        $net_coins_array=array_merge($total_coins_array,$sell_coin_array);
         $serialized_net_coins = serialize($net_coins_array);   
       $net_point=$net_point+$price;
       $fomart_net_point=sprintf('%0.2f', $net_point);
       $update_point_result=User::where('id', $user_result['id'])
             ->update(['net_coins' => $serialized_net_coins,'net_points'=>$fomart_net_point]);  
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
        
        $message="Success.";
        $status=200;
      }
      else
      {
        $user_data='';
        $message="Failed in update coin.";
        $status=400;
      }
       $result['result']=$user_data;
       $result['status']=$status;
       $result['message']=$message;
       return response()->json($result); 

      }    
   }
  
}
