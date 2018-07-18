<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coin_transaction extends Model
{
    protected $table = 'coin_transactions';
    protected $fillable = ['user_id','coin_id','quantity','price','commission','total_cost','status','left_coin','price_per_coin'];
    
    public function coin()
  {
    return $this->belongsTo('App\Model\Coin','coin_id');
  }
}
