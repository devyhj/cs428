<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['name', 'description', 'price'];

    public function menuCategory()
    {	
        return $this->belongsTo('App\MenuCategory');
    }

    public function orders()
    {	
        return $this->hasMany('App\Order');
    }

    public function menuOptions()
    {
        return $this->hasMany('App\MenuOption');
    }
}
