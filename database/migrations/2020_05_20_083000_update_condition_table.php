<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condition', function (Blueprint $table) {
            // Drop foreign key constraints so we can drop columns
            $table->dropForeign('condition_query_id_foreign');
            $table->dropForeign('condition_operator_id_foreign');
            $table->dropForeign('condition_property_id_foreign');
            $table->dropForeign('condition_value_id_foreign');
            // Drop old columns that are no longer used
            $table->dropColumn(['query_id','operator_id','property_id','value_id','value','id_values','table_type']);
            // Add new columns
            $table->enum('type',['istrue','not','and','or'])
                ->after('id');
            $table->integer('parent_cond_id')->nullable()->unsigned()
                ->after('type');
            $table->integer('action_id')->unsigned()
                ->after('parent_cond_id');
            // Foreign key constraints
            $table->foreign('parent_cond_id')->references('id')->on('condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condition', function (Blueprint $table) {
            $table->dropForeign(['parent_cond_id']);
            $table->dropForeign(['action_id']);

            $table->dropColumn(['action_id','parent_cond_id','type']);

            $table->unsignedInteger('query_id')
                ->after('id');;
            $table->unsignedInteger('operator_id')
                ->after('query_id');
            $table->unsignedInteger('property_id')
                ->after('operator_id');
            $table->unsignedInteger('value_id')->nullable()
                ->after('property_id');
            $table->string('value', 512)
                ->after('value_id');
            $table->integer('id_values')->nullable()
                ->after('value');
            $table->string('table_type', 5)
                ->after('id_values');

            $table->foreign('query_id')->references('id')->on('query')->onDelete('no action')->onUpdate('no action');
            $table->foreign('operator_id')->references('id')->on('operator')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('value_id')->references('id')->on('value')->onDelete('no action')->onUpdate('no action');
        });
    }
}
