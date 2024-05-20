<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionHasUserEvaluatedExpressionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condition_has_user_evaluated_expression', function (Blueprint $table) {
            $table->integer('condition_id')->unsigned();
            $table->integer('user_evaluated_expression_id')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            $table->foreign('condition_id')->references('id')->on('condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('user_evaluated_expression_id', 'condition_has_user_evaluated_expression_uee_id_foreign')->references('id')->on('user_evaluated_expression')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('condition_id', 'user_evaluated_expression_id'),'chuee_primary_keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('condition_has_user_evaluated_expression');
    }
}
