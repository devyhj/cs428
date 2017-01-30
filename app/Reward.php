<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'rewards';

    public function user()
    {	
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {	
        return $this->belongsTo('App\Restaurant');
    }
}
