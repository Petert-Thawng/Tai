<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Point_type extends Model
{
    protected $table = 'point_types';
    protected $fillable = ['type_name'];

    function FunctionName()
    {
    	# code...
    }
}
