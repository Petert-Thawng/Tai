<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $table = 'coins';
    protected $fillable = ['name','symbol'];
    public function coin_transaction()
    {
       return $this->hasMany('App\Model\Coin_transaction');
    }
}
