<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ar_condition', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['And', 'Or', 'Not', 'Comp Expression', 'Informal Expression']);
            $table->integer('action_id')->nullable()->unsigned();
            $table->integer('sub_ar_condition_id')->nullable()->unsigned();
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
        Schema::drop('ar_condition');
    }
}