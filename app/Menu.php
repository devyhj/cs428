<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menues';

    public function restaurant()
    {	
        return $this->belongsTo('App\Restaurant');
    }

    public function orders()
    {	
        return $this->hasMany('App\Orders');
    }
}
