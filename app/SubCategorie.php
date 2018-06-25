<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategorie extends Model
{
  public $table = "subcategories";

  public function categorie(){
    return $this->belongsTo(Categorie::class);
  }
}
