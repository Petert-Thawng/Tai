<?php
/**
 * Created by PhpStorm.
 * User: waiyan
 * Date: 2/1/18
 * Time: 12:15 PM
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Model\ScoreBoard;
use App\Model\User;
use Illuminate\Http\Request;
use Config;
use DB;
use App\Model\Coin;

class Rank_api_Controller extends Controller
{
    //ForRanking
    public function ranking(Request $request)
    {
        $facebook_id = $request['facebook_id'];
        // $user_data_all = ScoreBoard::get()->take(10)->toArray();
        $user_data_all = array();
        $user_all = ScoreBoard::orderBy('rank_points','desc')->take(10)->get()->toArray();
        $current_user=array();
        foreach ($user_all as $key => $value) {
            # code...
                $value['id']= $key+1;
               $user_data_all[]= $value;
        }
        $current_user = ScoreBoard::where('facebook_id',$facebook_id)->get()->toArray();
        $result['max_number'] = ScoreBoard::max('id');
        $user_data_all[]=$current_user[0];
        //Response Ranking Data
        $result['status'] = 200;
        $result['message'] = "success";
        $result['result'] = $user_data_all;
        return response()->json($result);
    }

    //NotUse
    public function current_point(Request $request)
    {
        $user_id=$request->input('facebook_id');
        $check_result=User::where('facebook_id',$facebook_id)->get()->toArray();


        $result['status'] = 200;
        $result['message'] = "success";
        $result['result'] = $user_id;
        return response()->json($user_id);
    }

// //***********//
//     public function cal_new($facebook_id)
//     {        # code...
//          $user_data_all=User::where('facebook_id',$facebook_id)->first()->toArray();
//         $current_price_url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,XLM,LTC,NEO,EOS,XEM&tsyms=USD";
//         $lastcoin = json_decode(file_get_contents($current_price_url), true);
//             //Unserialize NetCoin Data
//             $total_coins_array = unserialize($user_data_all['net_coins']);
//             $i = 0;
//             foreach ($total_coins_array as $coin => $value) {
//                 //NetCoinWith Current Prices
//                 $totalcoins[$i] =+ ($value / 1) * $lastcoin[$coin]['USD'];
//                 $i++;
//             }
            
//             $user_data_all["created_at"] = $this->getDateTime24Hr();
//             $user_data_all["updated_at"] = $this->getDateTime24Hr();
//             //UserDataArrayAddRankPoints
//             $user_data_all["id"] = "0" ;
//             $v = array_sum($totalcoins) + $user_data_all['net_points'];
//             $user_data_all["rank_points"] = number_format($v, 2,'.','');
        
//         unset($user_data_all["refferal_code"]);
//             unset($user_data_all["used_code"]);
//             unset($user_data_all["remember_token"]);
//             // unset($user_data_all["id"]);
//             unset($user_data_all["email"]);
//             unset($user_data_all["created_date"]);
//             unset($user_data_all["last_login_date"]);
//             unset($user_data_all["net_coins"]);
//             unset($user_data_all["net_points"]);
//         // //Sorting With Descending
//         // usort($user_data_all, function ($a, $b) {
//         //     return -1 * ($a['rank_points']-$b['rank_points']);
//         // });
//         return $user_data_all;
//     }

//     function getDateTime24Hr()
//     {
//         $timezone = 'Asia/Rangoon';
//         $date = new DateTime('now', new DateTimeZone($timezone));
//         $localtime = $date->format('Y-m-d H:i:s');
//         return $localtime;
//     }
// ///*********//
//     public function testing()
//     {
//         $current=array();
//         $coins = Coin::get()->toArray();
//         // dd($coins);
//          $current_price_url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,XLM,LTC,NEO,EOS,XEM&tsyms=USD";
//         $json = json_decode(file_get_contents($current_price_url), true);
//         // dd($json);
//         foreach ($coins as  $value) {
//             $a['usd']= $json[$value['symbol']]['USD'];
//             $a['symbol']= $value['symbol'];
//             $current[]=$a;
//         }
//         dd($current);
//     }
}
