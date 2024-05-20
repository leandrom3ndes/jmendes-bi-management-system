<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTermHasQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('term_has_query', function (Blueprint $table) {
            $table->dropForeign('term_has_query_query_id_foreign');
            $table->dropForeign('term_has_query_term_id_foreign');
            $table->dropPrimary();
        });

        Schema::table('term_has_query', function (Blueprint $table) {
            $table->increments('id')
                ->first();

            $table->foreign('term_id')->references('id')->on('term')->onDelete('no action')->onUpdate('no action');
            $table->foreign('query_id')->references('id')->on('query')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('term_has_query', function (Blueprint $table) {
            $table->dropPrimary();
            $table->unsignedInteger('id')->change();
            $table->dropColumn('id');
        });

        Schema::table('term_has_query', function (Blueprint $table) {
            $table->primary(array('term_id', 'query_id'),'thc_primary_keys');
        });
    }
}
