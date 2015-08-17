<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesagesTable extends Migration
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
            $table->integer('userId');
            $table->string('currencyFrom',3);
            $table->string('currencyTo',3);
            $table->double('amountSell',10,2);
            $table->double('amountBuy',10,2);
            $table->double('rate',10,4);
            $table->dateTime('timePlaced');
            $table->string('originatingCountry',2);
            $table->timestamps();

            $table->index('userId');
            $table->index('currencyFrom');
            $table->index('currencyTo');
            $table->index('amountSell');
            $table->index('amountBuy');
            $table->index('timePlaced');
            $table->index('originatingCountry');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
