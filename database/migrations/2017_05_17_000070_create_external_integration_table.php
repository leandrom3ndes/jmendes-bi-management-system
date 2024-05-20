<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalIntegrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_integration', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('ent_type_id')->unsigned();
			$table->integer('t_state_id')->unsigned();
            $table->string('name', 255)->nullable();
			$table->string('task', 255)->nullable();
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
        Schema::drop('external_integration');
    }
}