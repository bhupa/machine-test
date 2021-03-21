<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

    protected $table ='emails';

    protected $fillable =[
        'address',
        'contact_id',
        
    ];

    public $timestamps = true;
}
