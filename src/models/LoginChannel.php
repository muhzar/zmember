<?php

namespace Muhzar\Zmember\models;

use Illuminate\Database\Eloquent\Model;

class LoginChannel extends Model
{

    protected $table = 'login_channel';
    protected $fillable = [
        'name'
    ];

    public function scopeSearchByName($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "=", "$keyword");
            });
        }
        return $query;
    }

}
