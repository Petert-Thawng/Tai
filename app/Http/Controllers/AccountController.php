<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Point_transaction;
use App\Model\Coin;
use DB;
use App\Model\ScoreBoard;

use Config;

class AccountController extends Controller
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
    //Author Peter for logout and session destroy
    public function logout()
    {
        session()->flush('user_profile');
        return redirect('/');
        // return response()->json(['result' => 'logout out']);
    }
    public function check_user(Request $request)
    {
        // $person = json_decode($request->person);
        $facebook_id=$request['id'];
        $name=$request['name'];
        $picture=$request['picture'];
        $email=$request['email'];
        $check_result = User::where('facebook_id', $facebook_id)->get()->toArray();
        foreach ($check_result as $user)
        {
            $net_point=$user['net_points'];   
        }
        if(empty($check_result))
        {
            //create user
            $data = $this->create($facebook_id, $name,$email);
            //session 
            session()->put('user_profile',['name'=>$name,'picture'=>$picture,'point'=>$net_point,'facebook_id'=>$facebook_id]);
        }        
        else
        {
          //logged user
            $data = $this->login($facebook_id, $email);
            session()->put('user_profile',['name'=>$name,'picture'=>$picture,'point'=>$net_point,'facebook_id'=>$facebook_id]);
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
   

        public function create($facebook_id, $name,$email)
    {
        
       

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
            $this->user->net_coins =  $net_coins_serialize;// to serialize
            $this->user->net_points = 0;
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
            $result = $this->login($facebook_id,$email);
        }
//            if($request->ajax()) {
//   return response()->json([
//        'view' => view('welcome')->render(),
//   ]);
// }
        return json_encode($result);
 

    }
    public function login($facebook_id,$email)
    {

        // $user_data = User::where('facebook_id', $facebook_id)->first()->toArray();

        // if ($user_data['refferal_code'] == null) {
        //     $code = $this->generate_qrCode($facebook_id);
        //     $update_point_result = User::where('facebook_id', $facebook_id)
        //         ->update(['last_login_date' => $this->getDateTime(), 'email' => $email, 'refferal_code' => $code]);
        // }


        $update_point_result = User::where('facebook_id', $facebook_id)
            ->update(['last_login_date' => $this->getDateTime()]);

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
        return json_encode($result);
    }

    public function profile(Request $request)
    {


    // $res=session()->all('user_profile');
 // dd($res);
    // $n=$res['user_profile'];

        return redirect('show_api/BTC');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

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
