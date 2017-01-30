<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function visit()
    {	
        return $this->belongsTo('App\Visit');
    }

    public function menu()
    {	
        return $this->belongsTo('App\Menu');
    }
}
