<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template', function (Blueprint $table) {
            // Drop columns
            $table->dropForeign('template_action_id_foreign');
            $table->dropForeign('template_property_id_foreign');

            $table->dropColumn('action_id');
            $table->dropColumn('property_id');
            $table->dropColumn('type');
        });

        Schema::table('template', function (Blueprint $table) {
            $table->enum('type',['modal','toast', 'form_before', 'form_after', 'form_field','validation_warning'])
                ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('template', function (Blueprint $table) {
            $table->enum('type', ['modal','toast', 'form_before', 'form_after', 'form_field'])
                ->after('id');
            $table->unsignedInteger('action_id')
                ->after('type');
            $table->unsignedInteger('property_id')
                ->after('action_id');

            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
        });
    }
}
