<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends \Eloquent implements Authenticatable
{
  use AuthenticableTrait;
  use Notifiable;
  
  protected $fillable = [
    'name', 'email', 'password',
  ];

  protected $hidden = [
    'password', 'remember_token',
  ];
  
  public function tours(){
    return $this->hasMany('App\Tour');
  }
  
  public function posts(){
    return $this->hasMany('App\Post');
  }
  
  public function role(){
    return $this->belongsTo('App\Role');
  }
  
  public function products(){
    return $this->belongsToMany('App\Product');
  }

  public function agendasAvailable(){
      return $this->belongsToMany('App\Agenda');
    }
  public function languages(){
    return $this->belongsToMany('App\Language');
  }
}
