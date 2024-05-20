<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkEntityTypeIdColumnPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->integer('fk_entity_type_id')->unsigned()->nullable()
                ->after('fk_property_id');

            $table->foreign('fk_entity_type_id')->references('id')->on('ent_type')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->dropForeign(['fk_entity_type_id']);
            $table->dropColumn('fk_entity_type_id');
        });
    }
}
