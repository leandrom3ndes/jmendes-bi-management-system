<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLanguageValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('value', function (Blueprint $table) {
            $table->integer('language_id')->unsigned()->after('property_id')->nullable();
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('value', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
            $table->dropColumn('language_id');
        });
    }
}
