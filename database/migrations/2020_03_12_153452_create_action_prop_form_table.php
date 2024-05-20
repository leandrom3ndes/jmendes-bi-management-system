<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionPropFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

          Schema::create('action_prop_form', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('action_prop_id')->unsigned();
              $table->integer('form_id')->unsigned();
              $table->integer('lang_id')->unsigned();
              $table->integer('updated_by')->nullable()->unsigned();
              $table->integer('deleted_by')->nullable()->unsigned();
              $table->timestamps();
              $table->softDeletes();

              $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
              $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

              $table->foreign('action_prop_id')->references('id')->on('action_prop')->onDelete('no action')->onUpdate('no action');
              $table->foreign('form_id')->references('id')->on('form')->onDelete('no action')->onUpdate('no action');
              $table->foreign('lang_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
          });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('action_prop_form');
    }
}
