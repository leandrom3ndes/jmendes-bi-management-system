<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateActionPropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_prop', function (Blueprint $table) {
            $table->boolean('mandatory');
            $table->integer('order')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_prop', function (Blueprint $table) {
            $table->dropColumn('mandatory');
            $table->dropColumn('order');
        });
    }
}
