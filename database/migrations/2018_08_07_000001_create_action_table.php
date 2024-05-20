<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('action_rule_id')->unsigned();
            $table->enum('type', ['specify_data', 'if', 'then', 'else', 'while', 'foreach', 'WRITE_VALUE', 'READ_VALUE', 'PRODUCE_DOCUMENT', 'CLIENT_OUTPUT', 'EXTERNAL_CALL', 'C-ACT'])->nullable();
            $table->integer('order')->unsigned();
            $table->integer('par_action_id')->unsigned()->nullable();
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
        Schema::drop('action');
    }
}