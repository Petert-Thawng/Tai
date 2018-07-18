<?php
$base_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
//$base = $base_url  .= "://".$_SERVER['HTTP_HOST']."/web-fantasy-crypto";
// $base = "https://build.1shotcv.com/fantasy_b3";
$base = "http://192.168.10.211/web-fantasy-crypto";

$coin_logo_url=$base;
return  [
      'base_url'=>[
            'url'=>$base_url,
    ],
    'file_path'=>[
            'coin_logo' => $coin_logo_url.'/storage/coin_images/',
            'qr_path' =>  $base."/storage/public/qrcodes/",
            
    ],
    'version_control' =>[
    		'version_code' => '1.3',
    		'what_new' => ['Minor Bug Fix','Performantal improvement'],
    		'ignorable' => true,
    	],
];
