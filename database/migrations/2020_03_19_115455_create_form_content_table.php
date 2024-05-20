<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

          Schema::create('form_content', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('form_id')->unsigned();
              $table->integer('language_id')->unsigned();
              $table->string('name', 256);
              $table->json('json');
              $table->integer('updated_by')->nullable()->unsigned();
              $table->integer('deleted_by')->nullable()->unsigned();
              $table->timestamps();
              $table->softDeletes();

              $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
              $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

              $table->foreign('form_id')->references('id')->on('form')->onDelete('no action')->onUpdate('no action');
              $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
          });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('form_content');
    }
}
