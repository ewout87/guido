<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours';
  
    public function group(){
      return $this->belongsTo('App\Group');
    }
  
    public function product(){
      return $this->belongsTo('App\Product');
    }
  
    public function user(){
      return $this->belongsTo('App\User')->withDefault([
        'name' => 'Geen gids',]);
    }
  
    public function agenda(){
      return $this->belongsTo('App\Agenda', 'datum', 'datum')->withDefault([
        'datum' => null,]);
    }
}
