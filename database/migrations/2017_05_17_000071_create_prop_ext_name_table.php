<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropExtNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prop_ext_name', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('external_integration_id')->unsigned();
			$table->integer('property_id')->unsigned();
			$table->string('name', 255)->nullable();
			$table->enum('state', ['active', 'inactive']);
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
        Schema::drop('prop_ext_name');
    }
}