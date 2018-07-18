<?php

namespace App\Http\Controllers\Api;

use App\Model\Coin_transaction;
use App\Model\Point_transaction;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
class Transaction_api_Controller extends Controller
{
   public function get_all_transaction(Request $request)
   {
     $user_id=$request->input('user_id');
     $transaction_log=Coin_transaction::with('coin')->where('user_id',$user_id)->orderBy('created_at', 'desc')->get()->toArray();
     $final_ary=array();

     $point_transaction = Point_transaction::where('user_id',$user_id)->orderBy('created_at','desc')->get()->toArray();

     if(!empty($point_transaction))
     {
        foreach ($point_transaction as $point) {
            # code... 
            if($point['point_type_id'] == 2)
            {   $transaction_message = "You received Daily Reward."; }
            else if ($point['point_type_id'] == 3) 
            {   $transaction_message = "You received Video Reward."; }
            else if($point['point_type_id']==1)
            {   $transaction_message = "You received Initial Reward."; }
            else if($point['point_type_id']==4)
            {   $transaction_message = "You received Friend Referral Reward."; }


            $date=date_create($point['created_at']);
            $transaction_p['point']="+ ".$point['points']." points";
            $transaction_p['action']= 0;
            $transaction_p['date']=date_format($date,"d/M/y");
            $transaction_p['time']=date('h:i A',strtotime($point['created_at']));
            $transaction_p['log_text']=$transaction_message;  
            $final_ary[]=$transaction_p;

        }//foreach
     }

     if(!empty($transaction_log))
     {
       
        foreach ($transaction_log as $value) {
        $date=date_create($value['created_at']);
        //dd($value['quantity']);
        // $value['created_at']=date_format($date,"d/M/yy");
        $format_quantity=rtrim(rtrim(sprintf('%.8F', $value['quantity']), '0'),'.'); 

        if($value['status']==1)
        {
           $transaction_message="You bought ".$format_quantity." ".$value['coin']['name'];

           $transaction['point']="-".number_format($value['price'], 2,'.','')." points";
        }
        else
        {
           $transaction_message="You sold ".$format_quantity." ".$value['coin']['name'];
           $transaction['point']="+".number_format($value['price'], 2,'.','')." points";
        }
        $transaction['action']= $value['status'];
        $transaction['date']=date_format($date,"d/M/y");
        $transaction['time']=date('h:i A',strtotime($value['created_at']));
        $transaction['log_text']=$transaction_message;  
        $final_ary[]=$transaction;
     }
     

     }

     if(!empty($final_ary)){
     $result['result']=$final_ary;
     $result['status']=200;
     $result['message']="Success";
     return response()->json($result);
     }
     else
     {

        $transaction['point']="";
        $transaction['action']=0;
        $transaction['date']="";
        $transaction['time']="";
        $transaction['log_text']="";

     $result['result']=array('0'=>$transaction);
     $result['status']=400;
     $result['message']="No transaction log for this user.";
     return response()->json($result);  
     }

   }


   public function test_tran(Request $request)
   {

        $user_id=$request->input('user_id');
        $transaction_log=Coin_transaction::with('coin')->where('user_id',$user_id)->orderBy('created_at', 'desc')->get()->toArray();
        if(!empty($transaction_log))
        {
            foreach ($transaction_log as $value) {
                $date=date_create($value['created_at']);

                echo "date ".date_format($date,"d/M/y")."  time   ".date('h:i A',strtotime($value['created_at']))." number format ".number_format($value['price'], 2,'.','')."\n";
                // echo ;
            }   
        }
    }
}
