<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    

    protected $table ='accounts';

    protected $fillable =[
        'app_id',
        'app_url',
        'name',
        'app_token',
        'status'
    ];
}
