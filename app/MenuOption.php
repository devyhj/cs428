<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuOption extends Model
{
    protected $table = 'menu_options';
    protected $fillable = ['name', 'description', 'additional_price'];

    public function menuItem()
    {	
        return $this->belongsTo('App\MenuItem');
    }

    public function orders()
    {	
        return $this->belongsToMany('App\Order', 'order_option', 'order_id', 'option_id');
    }
}
