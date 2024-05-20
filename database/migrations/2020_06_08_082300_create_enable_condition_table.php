<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnableConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enable_condition', function (Blueprint $table) {
            $table->integer('action_prop_id')->unsigned();
            $table->integer('condition_id')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            $table->foreign('action_prop_id')->references('id')->on('action_prop')->onDelete('no action')->onUpdate('no action');
            $table->foreign('condition_id')->references('id')->on('condition')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('action_prop_id', 'condition_id'),'ec_primary_keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enable_condition');
    }
}
