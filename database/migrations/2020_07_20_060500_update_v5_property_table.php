<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateV5PropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            // Drop columns
            $table->dropForeign('property_action_id_foreign');
            $table->dropColumn('action_id');
            $table->boolean('requires_translation')
                ->after('fk_entity_type_id');
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
            $table->unsignedInteger('action_id')->nullable()
                ->after('id');
            $table->dropColumn('requires_translation');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });
    }
}
