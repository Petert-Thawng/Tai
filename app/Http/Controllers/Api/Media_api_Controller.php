<?php

namespace App\Http\Controllers\Api;
use App\Model\Coin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class Media_api_Controller extends Controller
{

    public function get_all()
    {
        $logo_file_path=Config::get('app_config.file_path.coin_logo');
        $coin_result=Coin::get()->toArray();

        foreach ($coin_result as $value) {
            $file_path=$logo_file_path.strtolower($value['symbol']).'.png';
            $final[] = array('coin_name' => $value['name'],'coin_symbol'=>strtolower($value['symbol']),'file_path'=>$file_path);
        }    
     $result['result']=$final;
     $result['status'] = 200;
     $result['message'] = "Success";
       return response()->json($result);
        
    }
    public function get(Request $request)
    {
        $coin=$request->input('coin');
     $logo_file_path=Config::get('app_config.file_path.coin_logo');
     $final['file_path']=$logo_file_path.strtolower($coin).'.png';
     $final['coin_name']=strtolower($coin);

     $result['result']=$final;
     $result['status'] = 200;
     $result['message'] = "Success";

    return response()->json($result);
    }


}
