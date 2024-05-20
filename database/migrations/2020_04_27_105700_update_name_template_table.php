<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNameTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('action_template','template');
        // So that the foreign keys identifier names stay up to date
        Schema::table('template', function (Blueprint $table) {
            $table->dropForeign('action_template_action_id_foreign');
            $table->dropForeign('action_template_property_id_foreign');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('template','action_template');
        Schema::table('action_template', function (Blueprint $table) {
            $table->dropForeign('template_action_id_foreign');
            $table->dropForeign('template_property_id_foreign');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
        });
    }
}
