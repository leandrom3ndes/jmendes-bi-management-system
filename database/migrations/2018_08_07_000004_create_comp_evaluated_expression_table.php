<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompEvaluatedExpressionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comp_evaluated_expression', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ar_condition_id')->nullable()->unsigned();
			$table->enum('operator', ['<', '>', '=', '!=', '~']);
            $table->integer('property_id1')->unsigned();
            $table->integer('value_id1')->nullable()->unsigned();
            $table->string('value1', 128)->nullable();
            $table->integer('property_id2')->nullable()->unsigned();
            $table->integer('action_id')->nullable()->unsigned();
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
        Schema::drop('comp_evaluated_expression');
    }
}