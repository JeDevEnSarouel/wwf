<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  public $table = "messages";

  public function subcategorie(){
    return $this->belongsTo(SubCategorie::class);
  }

}
