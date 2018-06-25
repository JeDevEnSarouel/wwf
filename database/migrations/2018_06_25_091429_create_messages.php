<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('messages', function (Blueprint $table) {
        $table->increments('id');
        $table->string('text');
        $table->integer('subcategorie_id')->unsigned();
        $table->timestamps();
      });

      Schema::table('messages', function($table) {
          $table->foreign('subcategorie_id')->references('id')->on('subcategories');
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
