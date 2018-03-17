<?php

namespace Muhzar\Zmember\models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'registers';
    protected $fillable = [
        'name', 'email', 'phone'
    ];

}
