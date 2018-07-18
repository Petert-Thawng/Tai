<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DateTime;
use DateTimeZone;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function getDateTime()
	{
	  $timezone = 'Asia/Rangoon';
	  $date = new DateTime('now', new DateTimeZone($timezone));
	  $localtime = $date->format('Y-m-d H:i:s');
	  return $localtime;
	}

	public function getdate()
	{
	  ini_set('date.timezone', 'Asia/Rangoon');
	  $dt = new DateTime();
	  $currDate = date_format($dt, 'Y-m-d');
	  return  $currDate;
	}
	/*  akt added */
	public function getDateTime24Hr()
	{
		$timezone = 'Asia/Rangoon';
		$date = new DateTime('now', new DateTimeZone($timezone));
		$localtime = $date->format('Y-m-d H:i:s');
		return $localtime;
	}

	public function generate_code()
    {
    	$str='';
    	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < 6; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
    }

    
}
