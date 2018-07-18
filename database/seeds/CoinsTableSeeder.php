<?php

use Illuminate\Database\Seeder;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coins')->truncate();
        $arr[0] = array('name' => 'Bitcoin','symbol'=>'BTC');
        $arr[1] = array('name' => 'Ethereum','symbol'=>'ETH');
        $arr[2] = array('name' => 'Ripple','symbol'=>'XRP');
        $arr[3] = array('name' => 'Bitcoin Cash','symbol'=>'BCH');
        $arr[4] = array('name' => 'Cardano','symbol'=>'ADA');
        $arr[5] = array('name' => 'Stellar','symbol'=>'XLM');
        $arr[6] = array('name' => 'Litecoin','symbol'=>'LTC');
        $arr[7] = array('name' => 'NEO','symbol'=>'NEO');
        $arr[8] = array('name' => 'EOS','symbol'=>'EOS');
        $arr[9] = array('name' => 'NEM','symbol'=>'XEM');

        foreach ($arr as $value) 
        {
            DB::table('coins')->insert($value);
        }
    }
}
