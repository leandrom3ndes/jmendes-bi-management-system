<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausalLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causal_link', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('causing_action')->unsigned();
            $table->integer('caused_action_rule')->unsigned();
            $table->string('min', 45);
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
        Schema::drop('causal_link');
    }
}
