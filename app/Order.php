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

    public function menuItem()
    {	
        return $this->belongsTo('App\MenuItem');
    }

    public function options()
    {	
        return $this->belongsToMany('App\MenuOption', 'order_option', 'option_id', 'order_id');
    }
}
