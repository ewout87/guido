<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
  
    public function tours(){
    return $this->hasMany('App\Tour');
    }  
    public function users(){
    return $this->belongsToMany('App\User');
  }
}
