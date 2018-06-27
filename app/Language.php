<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
  
    public function groups(){
    return $this->hasMany('App\Group');
    }
    public function users(){
    return $this->belongsToMany('App\User');
    }
}