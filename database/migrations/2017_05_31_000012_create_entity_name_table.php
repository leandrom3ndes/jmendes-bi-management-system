<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_name', function (Blueprint $table) {
            $table->integer('entity_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name', 255)->nullable();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('entity_id', 'language_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('entity_name');
    }
}
