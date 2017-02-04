<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';

    public function user()
    {	
        return $this->belongsTo('App\User');
    }

    public function rewards()
    {	
        return $this->hasMany('App\Reward');
    }

    public function visits()
    {	
        return $this->hasMany('App\Visit');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
}
