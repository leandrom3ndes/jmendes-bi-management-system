<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompEvaluatedExpressionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comp_evaluated_expression', function (Blueprint $table) {
            // Drop foreign key constraints so we can drop columns
            $table->dropForeign('comp_evaluated_expression_ar_condition_id_foreign');
            $table->dropForeign('comp_evaluated_expression_property_id1_foreign');
            $table->dropForeign('comp_evaluated_expression_value_id1_foreign');
            $table->dropForeign('comp_evaluated_expression_property_id2_foreign');
            $table->dropForeign('comp_evaluated_expression_action_id_foreign');
            // Drop old columns that are no longer used
            $table->dropColumn(['ar_condition_id','operator','property_id1','value_id1','value1','property_id2','action_id']);
            // Add new columns
            $table->integer('parent_cond_id')->unsigned()
                ->after('id');
            $table->enum('logical_operator',['==','!=','<','>','~'])
                ->after('parent_cond_id');
            $table->integer('term_1_id')->unsigned()
                ->after('logical_operator');
            $table->integer('term_2_id')->unsigned()
                ->after('term_1_id');
            // Foreign key constraints
            $table->foreign('parent_cond_id')->references('id')->on('condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('term_1_id')->references('id')->on('term')->onDelete('no action')->onUpdate('no action');
            $table->foreign('term_2_id')->references('id')->on('term')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comp_evaluated_expression', function (Blueprint $table) {
            $table->dropForeign(['parent_cond_id']);
            $table->dropForeign(['term_1_id']);
            $table->dropForeign(['term_2_id']);

            $table->dropColumn(['term_2_id','term_1_id','logical_operator','parent_cond_id']);

            $table->unsignedInteger('ar_condition_id')->nullable()
                ->after('id');
            $table->enum('operator', ['<', '>', '=', '!=', '~'])
                ->after('ar_condition_id');
            $table->unsignedInteger('property_id1')
                ->after('operator');
            $table->unsignedInteger('value_id1')->nullable()
                ->after('property_id1');
            $table->string('value1', 128)->nullable()
                ->after('value_id1');
            $table->unsignedInteger('property_id2')->nullable()
                ->after('value1');
            $table->unsignedInteger('action_id')->nullable()
                ->after('property_id2');

            $table->foreign('ar_condition_id')->references('id')->on('ar_condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id1')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('value_id1')->references('id')->on('value')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id2')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });
    }
}
