<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropAllowedValueNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prop_allowed_value_name', function (Blueprint $table) {
            $table->integer('p_a_v_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name', 128)->nullable();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('p_a_v_id')->references('id')->on('prop_allowed_value')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('p_a_v_id', 'language_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prop_allowed_value_name');
    }
}
