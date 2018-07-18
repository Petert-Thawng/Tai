<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\Coin;
use App\Model\Point_transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Config;

class Base_api_Controller extends Controller
{
  public function get_daily_bonus(Request $request)
  {

    $rules = array(
      'user_id' => 'required'

    );

    $validator = Validator::make(Input::all(), $rules);

    if($validator->fails())
    {

      return response()->json(
        [
          'result' => 0,
          'status' => 400,
          'message' => 'Please provide username. or Please provide password'
        ]);
    }
    else
    {
      $user_id=$request->input('user_id');
//check functin goes here
      $check_user=$this->check_daily_bonus($user_id,2);
      $user_result=User::where('id',$user_id)->first()->toArray();//get updated
if($user_result['net_coins']!=null)
{
  $total_coins_array=unserialize($user_result['net_coins']);
  $i=0;
  foreach ($total_coins_array as $key => $value) {

        $coin_result[$i]['coin_name']=$key;
        $coin_result[$i]['quantity']=$value;
        $i+=1;

      }

  $user_result['net_coins']=$coin_result;
}
if($check_user)
{
  DB::beginTransaction();
  try{
    $this->point=new Point_transaction();
    $this->point->user_id=$user_id;
    $this->point->point_type_id=2;
    $this->point->points=300;
    $this->point->created_date=$this->getDate(); 
    $this->point->created_at= $this->getDateTime();           
    $point_save_result=$this->point->save(); 
    $user_result=User::where('id',$user_id)->first()->toArray();
    $net_point=$user_result['net_points']+300; 
    $update_point_result=User::where('id', $user_id)
    ->update(['net_points'=>$net_point]);
  }catch(\Exception $e)
  {
    DB::rollback();
    throw $e;
  }
  DB::commit();

  $result['status'] = 200;
  $result['message'] = "Success";
  $result['result']=$user_result;
  return response()->json($result);
}
else
{
  $result['status'] = 400;
  $result['message'] = "Already got daily award.";
  $result['result']=$user_result;
  return response()->json($result);  
}
}
}
public function get_video_bonus(Request $request)
{
  $rules = array(
    'user_id' => 'required'
  );

  $validator = Validator::make(Input::all(), $rules);

  if($validator->fails())
  {
    return response()->json(
      [
        'result' => 0,
        'status' => 400,
        'message' => 'Please provide username. or Please provide password'
      ]);
  }
  else
  {
    $user_id=$request->input('user_id');
  //check functin goes here      
    $user_result=User::where('id',$user_id)->first()->toArray();//get updated

    DB::beginTransaction();
    try{
      $this->point=new Point_transaction();
      $this->point->user_id=$user_id;
      $this->point->point_type_id=3;
      $this->point->points=30;
      $this->point->created_date=$this->getDate();
      $this->point->created_at= $this->getDateTime();      
      $point_save_result=$this->point->save(); 


      $net_point=$user_result['net_points']+30; 
      $update_point_result=User::where('id', $user_id)
      ->update(['net_points'=>$net_point]);
    }catch(\Exception $e)
    {
      DB::rollback();
      throw $e;
    }
    DB::commit();
     // dd($user_result);
     $user_result['net_points']+=30;

     $user_result['net_points'] = number_format($user_result['net_points'], 2,'.','');
     
    if($user_result['net_coins']!=null)
    {
      $total_coins_array=unserialize($user_result['net_coins']);
      $i=0;
      foreach ($total_coins_array as $key => $value) {
        $coin_result[$i]['coin_name']=$key;
        $coin_result[$i]['quantity']=$value;
        $i+=1;
      }
      $user_result['net_coins']=$coin_result;
    }
    $result['status'] = 200;
    $result['message'] = "Success";
    $result['result']=$user_result;
    return response()->json($result);
  }
}

public function check_daily_bonus($user_id,$point_type_id)
{
  $user=Point_transaction::where('created_date',$this->getdate())->where('user_id',$user_id)->where('point_type_id',$point_type_id)->get()->toArray();
  if(!empty($user))
  {
    return false;//already got daily bonus
  }
  else
  { 
    return true;//not get daily bonus yet
  }
}

public function check_daily_bonus_api(Request $request)
{
  $rules = array(
    'user_id' => 'required'
  );

  $validator = Validator::make(Input::all(), $rules);
  if($validator->fails())
  {
    return response()->json(
      [
        'result' => 0,
        'status' => 400,
        'message' => 'Please provide id.'
      ]);
  }
  else
  {
    $user_id=$request->input('user_id');
    $check_user=$this->check_daily_bonus($user_id,2);
    if($check_user==false)//got
    {
      $result['status'] = 200;
      $result['message'] = "Already got.";
      $result['result']='';
      return response()->json($result);  
    }
    else
    {
      $result['status'] = 400;
      $result['message'] = "No get daily award.";
      $result['result']='';
      return response()->json($result);  
    }
  }
}
public function weekly(Request $request)
{
  $rules = array(
    'coin_name' => 'required'
  );

  $validator = Validator::make(Input::all(), $rules);

  if($validator->fails())
  {
    return response()->json(
      [
        'result' => 0,
        'status' => 400,
        'message' => 'Please provide coin name.'
      ]);
  }
  else
  {
    $coin_name=$request->input('coin_name');
    $url = "https://min-api.cryptocompare.com/data/histohour?fsym=".$coin_name."&tsym=USD&limit=168&aggregate=1";

    $json = json_decode(file_get_contents($url), true);

    foreach ($json["Data"] as $key=> $vale) {
      $json["Data"][$key]["time"]=date('d-M', $vale["time"]);
    }

    return response()->json($json);
  }
}
public function check_update()
{
    # code...
 return response()->json(Config::get('app_config.version_control'));
}

}
