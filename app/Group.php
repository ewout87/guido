<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
  
    public function tour(){
    return $this->hasMany('App\Tour');
  }
    public function language(){
    return $this->belongsTo('App\Language');
    }
}
