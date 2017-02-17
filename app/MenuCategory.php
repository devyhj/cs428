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

    public function menus()
    {
    	return $this->hasMany('App\Menu');
    }
}
