<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
  public $table = "reponses";

  public function message(){
    return $this->belongsTo(Message::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }

}
