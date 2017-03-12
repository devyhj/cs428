<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $table = 'menu_categories';
    protected $fillable = ['name'];

    public function restaurant()
    {	
        return $this->belongsTo('App\Restaurant');
    }

    public function menuItems()
    {
    	return $this->hasMany('App\MenuItem');
    }
}
