<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_rule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('t_state_id')->unsigned();
            $table->integer('transaction_type_id')->unsigned();
            $table->longText('blockly_xml')->nullable();
            $table->longText('blockly_code')->nullable();
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
        Schema::drop('action_rule');
    }
}