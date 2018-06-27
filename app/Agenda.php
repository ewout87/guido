<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    public function usersAvailable(){
      return $this->belongsToMany('App\User');
    }

    public function tours(){
      return $this->hasMany('App\Tour', 'datum');
    }
}
