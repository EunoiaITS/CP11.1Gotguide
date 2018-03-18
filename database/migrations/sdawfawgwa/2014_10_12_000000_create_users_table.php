<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('language');
            $table->date('dob');
            $table->string('country');
            $table->string('city');
            $table->string('contact');
            $table->enum('role', array('admin', 'traveller', 'agent'));
            $table->text('informations');
            $table->string('profile_img');
            $table->string('back_img');
            $table->enum('payment_status', array('paid', 'unpaid'));
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
