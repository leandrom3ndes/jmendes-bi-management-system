<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelegationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('delegates_role_id')->unsigned();
            $table->integer('delegated_role_id')->unsigned();
            $table->integer('t_state_id')->unsigned();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->enum('state', ['active','inactive']);
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('delegation');
    }
}
