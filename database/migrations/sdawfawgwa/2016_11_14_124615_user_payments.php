<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payments', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('amount');
            $table->enum('payment_type', array('1', '2'));
            $table->dateTime('payment_time');
            $table->enum('payment_status', array('paid', 'unpaid', 'pending'));
            $table->date('payment_expiry');
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
        Schema::drop('user_payment');
    }
}
