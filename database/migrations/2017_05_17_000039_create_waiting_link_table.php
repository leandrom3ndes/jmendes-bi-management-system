<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaitingLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiting_link', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('waited_t')->unsigned();
            $table->integer('waited_act')->unsigned();
            $table->integer('waiting_act')->unsigned();
            $table->integer('waiting_t')->unsigned();
            $table->string('min',45);
            $table->string('max', 45);
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
        Schema::drop('waiting_link');
    }
}
