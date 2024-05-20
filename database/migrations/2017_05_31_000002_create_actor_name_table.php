<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_name', function (Blueprint $table) {
            $table->integer('actor_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name', 200);
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('actor_id')->references('id')->on('actor')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('actor_id', 'language_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actor_name');
    }
}
