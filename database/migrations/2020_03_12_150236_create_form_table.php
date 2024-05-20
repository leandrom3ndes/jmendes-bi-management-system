<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

      Schema::create('form', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('action_id')->unsigned();
          $table->integer('updated_by')->nullable()->unsigned();
          $table->integer('deleted_by')->nullable()->unsigned();
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
          $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

          $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
      });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('form');
    }
}
