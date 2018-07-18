<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\User;
use DB;
use DateTime;
use DateTimeZone;

class CalculateScoreBoard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:CalculateScoreBoard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate ScoreBoard Ranks daily.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
       // Log::info('Hello from the other side.');
        $this->ranking();
        $this->info('Cron maked successfully. ScoreBoard Data have been changed.');
        

    }

    function getDateTime24Hr()
    {
        $timezone = 'Asia/Rangoon';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $localtime = $date->format('Y-m-d H:i:s');
        return $localtime;
    }

    public function ranking()
    {
         //GetAllUserData
        $user_data_all = User::get()->toArray();
        $current_price_url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,XLM,LTC,NEO,EOS,XEM&tsyms=USD";
        $lastcoin = json_decode(file_get_contents($current_price_url), true);
        
        foreach ($user_data_all as $key => $user) {

            //Unserialize NetCoin Data
            $total_coins_array = unserialize($user['net_coins']);
            
            $i = 0;
            foreach ($total_coins_array as $coin => $value) {
                //NetCoinWith Current Prices
                $totalcoins[$i] =+ ($value / 1) * $lastcoin[$coin]['USD'];
                $i++;
            }

            unset($user_data_all[$key]["used_code"]);
            unset($user_data_all[$key]["refferal_code"]);

            unset($user_data_all[$key]["remember_token"]);
            unset($user_data_all[$key]["id"]);
            unset($user_data_all[$key]["email"]);
            unset($user_data_all[$key]["created_date"]);
            unset($user_data_all[$key]["last_login_date"]);
            unset($user_data_all[$key]["net_coins"]);
            unset($user_data_all[$key]["net_points"]);
            $user_data_all[$key]["created_at"] = $this->getDateTime24Hr();
            $user_data_all[$key]["updated_at"] = $this->getDateTime24Hr();
            
            //UserDataArrayAddRankPoints
            $v = array_sum($totalcoins) + $user['net_points'];
            $user_data_all[$key]["rank_points"] = number_format($v, 2,'.','');
        }

        //Sorting With Descending
        usort($user_data_all, function ($a, $b) {
            return -1 * ($a['rank_points']-$b['rank_points']);
        });    
        
        DB::table('scoreboard')->truncate();
        DB::table('scoreboard')->insert($user_data_all);

    }

}
