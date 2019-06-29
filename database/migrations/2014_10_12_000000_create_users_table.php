<?php

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
            $table->integer('city_id')->unsigned();
            $table->string('address');
            $table->string('phone')->nullabel();
            $table->string('cell_phone');
            $table->integer('is_admin')->unsigned()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        
        // Schema::table('users', function (Blueprint $table) {
        //     $table->foreign('city_id')
        //           ->references('id')
        //           ->on('cities')
        //           ->onDelete('cascade');
        // });
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
