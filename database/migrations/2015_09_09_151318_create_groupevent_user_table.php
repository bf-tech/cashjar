<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupeventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupevent_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('groupevent_id')->unsigned();
            $table->foreign('user_id')
                          ->references('id')
                          ->on('users')
                          ->onDelete('cascade');
            $table->foreign('groupevent_id')
                  ->references('id')
                  ->on('groupevents')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groupevent_user');
    }
}
