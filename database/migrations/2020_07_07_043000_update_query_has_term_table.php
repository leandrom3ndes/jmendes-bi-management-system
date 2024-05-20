<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQueryHasTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('query_has_term', function (Blueprint $table) {
            // Drop fk constraints  and pk constraint so we can drop column query id
            $table->dropForeign('query_has_term_query_id_foreign');
            $table->dropForeign('query_has_term_term_id_foreign');
            $table->dropPrimary();
            // Drop column query_id
            $table->dropColumn('query_id');
            // Add new column
            $table->integer('term_has_query_id')->unsigned()
                ->after('term_id');
            // Foreign key constraints and pk constraint
            $table->foreign('term_id')->references('id')->on('term')->onDelete('no action')->onUpdate('no action');
            $table->foreign('term_has_query_id')->references('id')->on('term_has_query')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('term_has_query_id', 'term_id'),'qht_primary_keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('query_has_term', function (Blueprint $table) {
            $table->dropForeign(['term_id']);
            $table->dropForeign(['term_has_query_id']);
            $table->dropPrimary();

            $table->dropColumn('term_has_query_id');
            $table->unsignedInteger('query_id')
                ->after('term_id');

            $table->foreign('term_id')->references('id')->on('term')->onDelete('no action')->onUpdate('no action');
            $table->foreign('query_id')->references('id')->on('query')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('query_id', 'term_id'),'qht_primary_keys');
        });
    }
}
