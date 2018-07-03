<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReponseMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('reponses', function (Blueprint $table) {
        $table->increments('id');
        $table->string('text', 4000);
        $table->integer('message_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->timestamps();
      });

      Schema::table('reponses', function($table) {
          $table->foreign('message_id')->references('id')->on('messages');
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
