<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = ['name', 'address_line1', 'address_line2', 'city', 'state', 'zip_code'];

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

    public function menuCategories()
    {
        return $this->hasMany('App\MenuCategory');
    }
}
