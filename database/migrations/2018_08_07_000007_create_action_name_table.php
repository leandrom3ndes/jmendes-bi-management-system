<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_name', function (Blueprint $table) {
            $table->integer('action_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name', 200);
            $table->string('description', 500)->nullable();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('action_id', 'language_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('action_name');
    }
}