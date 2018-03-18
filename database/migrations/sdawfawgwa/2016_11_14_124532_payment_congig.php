<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentCongig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_config', function(Blueprint $table){
            $table->increments('id');
            $table->enum('payment_type', array('1', '2'));
            $table->integer('amount');
            $table->string('currency');
            $table->enum('is_promotional', array('Yes', 'No'));
            $table->string('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_config');
    }
}
