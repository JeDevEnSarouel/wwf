<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('subcategories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('titre');
        $table->integer('categorie_id')->unsigned();
        $table->timestamps();
      });

      Schema::table('subcategories', function($table) {
          $table->foreign('categorie_id')->references('id')->on('categories');
      });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategories');
    }
}
