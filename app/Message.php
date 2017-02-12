<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['text'];

    public function visit()
    {	
        return $this->belongsTo('App\Visit');
    }
}
