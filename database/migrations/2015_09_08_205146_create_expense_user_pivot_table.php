<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('expense_id')->unsigned();
            $table->boolean('paid')->default(Null);
            $table->timestamps();
            $table->foreign('user_id')
        				  ->references('id')
        				  ->on('users')
        				  ->onDelete('cascade');
            $table->foreign('expense_id')
                  ->references('id')
                  ->on('expenses')
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
        Schema::drop('expense_user');
    }
}
