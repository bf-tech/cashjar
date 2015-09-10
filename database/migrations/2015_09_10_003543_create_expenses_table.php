<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('desc');
            $table->integer('cost');
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
        Schema::drop('expenses');
    }
}
