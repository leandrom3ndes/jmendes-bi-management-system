<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserEvaluatedExpressionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_evaluated_expression', function (Blueprint $table) {
            // Drop foreign key constraints so we can drop columns
            $table->dropForeign('user_evaluated_expression_ar_condition_id_foreign');
            $table->dropForeign('user_evaluated_expression_action_id_foreign');
            // Drop old columns that are no longer used
            $table->dropColumn(['string','ar_condition_id','action_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_evaluated_expression', function (Blueprint $table) {
            $table->string('string', 100)
                ->after('id');
            $table->unsignedInteger('ar_condition_id')->nullable()
                ->after('string');
            $table->unsignedInteger('action_id')->nullable()
                ->after('ar_condition_id');

            $table->foreign('ar_condition_id')->references('id')->on('ar_condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });
    }
}
