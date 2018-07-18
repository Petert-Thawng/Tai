<?php

use Illuminate\Database\Seeder;

class Point_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('point_types')->truncate();
        $arr[0] = array('type_name' => 'initial_reward');
        $arr[1] = array('type_name' => 'daily_reward');
        $arr[2] = array('type_name' => 'video_reward');
        

        foreach ($arr as $value) 
        {
            DB::table('point_types')->insert($value);
        }
    }
}
