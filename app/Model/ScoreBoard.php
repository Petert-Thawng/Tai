<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ScoreBoard extends Model
{
    //
      protected $table = 'scoreboard';
    protected $fillable = ['facebook_id','name','rank_points','created_at','updated_at'];
}
