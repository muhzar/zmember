<?php

namespace Muhzar\Zmember\models;

use Illuminate\Database\Eloquent\Model;

class MemberLogin extends Model
{

    protected $table = 'register_logins';
    protected $fillable = [
        'email', 'password', 'channel_id', 'attributes'
    ];

}
