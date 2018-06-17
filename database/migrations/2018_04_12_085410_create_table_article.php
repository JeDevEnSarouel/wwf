<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('articles', function (Blueprint $table) {
        $table->increments('id');
        $table->string('titre');
        $table->string('texte');
        $table->integer('user_id')->unsigned();
        $table->timestamps();
      });

      Schema::table('articles', function($table) {
          $table->foreign('user_id')->references('id')->on('users');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
