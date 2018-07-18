<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name','email','profile_url','created_date','last_login_date','net_coins','net_pints','refferal_code','used_code'];
}
