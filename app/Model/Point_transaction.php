<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Point_transaction extends Model
{
    protected $table = 'point_transactions';
    protected $fillable = ['user_id','point_type_id','points','created_date','created_at'];

}
