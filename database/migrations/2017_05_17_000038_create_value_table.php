<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->nullable()->unsigned();
            $table->integer('property_id')->unsigned();
            $table->longText('value')->nullable();
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
        Schema::drop('value');
    }
}
