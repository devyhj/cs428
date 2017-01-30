<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
	protected $table = 'visits';

    public $timestamps = false;

    public function user()
    {   
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {   
        return $this->belongsTo('App\Restaurant');
    }

    public function orders()
    {   
        return $this->hasMany('App\Order');
    }

    public function messages()
    {   
        return $this->hasMany('App\Message');
    }
}
