<?php

namespace App\Http\Controllers\Api;

use App\Model\User;
use App\Model\Point_transaction;
use App\Model\Coin;
use App\Model\ScoreBoard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use DB;
use Session;
use QrCode;
use File;


class Login_api_Controller extends Controller
{

    public function logout()
    {
        session()->flush();
        return response()->json(['result' => 'logout out']);
    }

    public function check_user(Request $request)
    {

// dd();
        $rules = array(
            'facebook_id' => 'required',
            // 'name' => 'required|nullable'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'result' => 0,
                    'status' => 400,
                    'message' => 'Please provide coin name.'
                ]);
        } else {
            // dd(session()->all());
            $facebook_id = $request->input('facebook_id');
            $name = $request->input('name');
            $email = $request->input('email');

            $check_result = User::where('facebook_id', $facebook_id)->get()->toArray();
            // dd($check_result);
            if (empty($check_result)) {
                //create user
                $data = $this->create($facebook_id, $name, $email);
                session()->put('user_info', $data);
            } else {
                //logged user
                $data = $this->login($facebook_id, $email);
                session()->put('user_info', $data);
            }

            $current_user = ScoreBoard::where('facebook_id', $facebook_id)->first();
            if (empty($current_user)) {
                $ScoreBoard = new ScoreBoard();
                $ScoreBoard->facebook_id = $facebook_id;
                $ScoreBoard->name = $check_result[0]['name'];
                $ScoreBoard->rank_points = $check_result[0]['net_points'];
                $ScoreBoard->save();
            }

            return response()->json($data);
        }
    }

    public function create($facebook_id, $name, $email)
    {
        /*
        generate referal code
        */

        $code = $this->generate_code($facebook_id);
        // $user = User::where('refferal_code',$code)->get()->toArray();
        // // dd($code);
        //  while (!empty($user)) {
        //    # code...
        //    $code = $this->generate_code($facebook_id);
        //     $user = User::where('refferal_code',$code)->get()->toArray();
        //  }

        DB::beginTransaction();
        try {
            $all_coins_result = Coin::get()->toArray();
            $primary_coin = array();
            foreach ($all_coins_result as $value) {
                $primary_coin[$value['symbol']] = 0;
            }
            $net_coins_serialize = serialize($primary_coin);
            $this->user = new User();
            $this->user->facebook_id = $facebook_id;
            $this->user->name = $name;
            $this->user->email = $email;
            $this->user->created_date = $this->getDateTime();
            $this->user->last_login_date = $this->getDateTime();
            $this->user->net_coins = $net_coins_serialize;
            $this->user->net_points = 0;
            $this->refferal_code = $code;
            $save_result = $this->user->save();

            $this->point = new Point_transaction();
            $this->point->user_id = $this->user->id;
            $this->point->point_type_id = 1;
            $this->point->points = 30000;
            $this->point->created_date = $this->getDate();
            $point_save_result = $this->point->save();

            $update_point_result = User::where('id', $this->user->id)
                ->update(['net_points' => 30000]);
        } catch (\Exception $e) {
            //failed logic here
            DB::rollback();
            throw $e;
        }

        // $this->generate_qrCode($facebook_id);
        DB::commit();

        if ($save_result) {
            $result = $this->login($facebook_id, $email);
        }
        return $result;

    }

    public function login($facebook_id, $email)
    {

        $user_data = User::where('facebook_id', $facebook_id)->first()->toArray();

        if ($user_data['refferal_code'] == null) {
            $code = $this->generate_qrCode($facebook_id);
            $update_point_result = User::where('facebook_id', $facebook_id)
                ->update(['last_login_date' => $this->getDateTime(), 'email' => $email, 'refferal_code' => $code]);
        }


        $update_point_result = User::where('facebook_id', $facebook_id)
            ->update(['last_login_date' => $this->getDateTime(), 'email' => $email]);

        $user_data = User::where('facebook_id', $facebook_id)->first()->toArray();

        if ($user_data['net_coins'] != null) {

            $total_coins_array = unserialize($user_data['net_coins']);
            $i = 0;
            foreach ($total_coins_array as $key => $value) {

                $coin_result[$i]['coin_name'] = $key;
                $coin_result[$i]['quantity'] = $value;
                $i += 1;

            }
            $path = Config::get('app_config.file_path.qr_path');

            $user_data['net_coins'] = $coin_result;
            $user_data['qr_path'] = $path . $user_data['refferal_code'] . ".png";
        }

        $result['result'] = $user_data;
        $result['status'] = 200;
        $result['message'] = "Login Successfully.";
        return $result;
    }

    public function get_account_data(Request $request)
    {
        $facebook_id = $request->input('facebook_id');

        $user_result = User::where('facebook_id', $facebook_id)->first()->toArray();//get updated data again

        if ($user_result['net_coins'] != null) {
            $total_coins_array = unserialize($user_result['net_coins']);
            $i = 0;
            foreach ($total_coins_array as $key => $value) {

                $coin_result[$i]['coin_name'] = $key;
                $coin_result[$i]['quantity'] = $value;
                $i += 1;

            }
            $user_result['net_points'] = number_format($user_result['net_points'], 2, '.', '');
            $user_result['net_coins'] = $coin_result;
        }
        $result['result'] = $user_result;
        $result['status'] = 200;
        $result['message'] = "Success";
        return response()->json($result);
    }

    public function generate_qrCode($facebook_id)
    {
        $refferal_code = $this->generate_code($facebook_id);
        $user = User::where('refferal_code', $refferal_code)->get()->toArray();
        while (!empty($user)) {
            $refferal_code = $this->generate_code($facebook_id);
            $user = User::where('refferal_code', $refferal_code)->get()->toArray();
        }
        $path = Config::get('app_config.file_path.qr_path');
        if (!is_dir($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if (!File::exists($path . $refferal_code . ".png")) {
            QrCode::size(1000);
            QrCode::format('png');
            QrCode::encoding('UTF-8')->size(300)->margin(1)->generate($refferal_code, $path . $refferal_code . ".png");
        }
        return $refferal_code;
    }


    public function generate_all_qrcodes(Request $request)
    {
        # code...
        if ($request['password'] == 'F@nt@$yC#yp!0') {
            $users = User::get()->toArray();
            foreach ($users as $user) {
                # code...
                if (empty($user['refferal_code'])) {
                    $code = $this->generate_qrCode($user['facebook_id']);
                    User::where('facebook_id', $user['facebook_id'])
                        ->update(['refferal_code' => $code]);
                }
            }
            echo "Success";
        }
    }


    public function scan_qr(Request $request)
    {
        # code...
        $facebook_id = $request['facebook_id'];
        $used_code = $request['used_code'];

        $rules = array(
            'facebook_id' => 'required',
            'used_code' => 'required|exists:users,refferal_code'
        );

        $message = [
            'facebook_id.required' => 'Facebook Id is required.!',
            'used_code.required' => 'Used Code is required.!',
            'used_code.exists' => 'Used Code does not exist.',

        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'result' => 0,
                    'status' => 400,
                    'message' => $validator->errors(),
                ]);
        } else {
            $used_user_model = User::where('facebook_id', $facebook_id)->where('refferal_code', '!=', $used_code)->first();

            // dd($used_user_model);
            if(empty($used_user_model['used_code']))
            {

                $used_user = User::where('facebook_id', $facebook_id)->update(['used_code' => $used_code,'net_points'=>number_format($used_user_model['net_points']+1000, 2, '.', '')]);
                if ($used_user) {
                    $refer_user = User::where('refferal_code', $used_code)->first();

                    $refer_user->net_points = number_format($refer_user['net_points']+1000, 2, '.', '');
                    $refer_user->save();

                    $this->point=new Point_transaction();
                    $this->point->user_id=$used_user_model['id'];
                    $this->point->point_type_id=4;
                    $this->point->points=1000;
                    $this->point->created_date=$this->getDate();
                    $this->point->created_at= $this->getDateTime();
                    $point_save_result=$this->point->save();

                    $this->point=new Point_transaction();
                    $this->point->user_id=$refer_user['id'];
                    $this->point->point_type_id=4;
                    $this->point->points=1000;
                    $this->point->created_date=$this->getDate();
                    $this->point->created_at= $this->getDateTime();
                    $point_save_result=$this->point->save();


                    $user_data = User::where('facebook_id', $facebook_id)->first()->toArray();

                    if ($user_data['net_coins'] != null) {

                        $total_coins_array = unserialize($user_data['net_coins']);
                        $i = 0;
                        foreach ($total_coins_array as $key => $value) {

                            $coin_result[$i]['coin_name'] = $key;
                            $coin_result[$i]['quantity'] = $value;
                            $i += 1;

                        }
                        $path = Config::get('app_config.file_path.qr_path');

                        $user_data['net_coins'] = $coin_result;
                        $user_data['qr_path'] = $path . $user_data['refferal_code'] . ".png";
                    }

                    $result['result'] = $user_data;
                    $result['status'] = 200;
                    $result['message'] = "Successfully got Friend Referral Reward.";
                    return $result;

                } else {
                    //show error
                }
            }
            else{
                return response()->json(
                    [
                        'result' => 0,
                        'status' => 400,
                        'message' =>"You already used referral code.",
                    ]);
            }

        }
    }


}
