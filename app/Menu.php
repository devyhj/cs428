<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    public function restaurant()
    {	
        return $this->belongsTo('App\Restaurant');
    }

    public function orders()
    {	
        return $this->hasMany('App\Order');
    }
}
