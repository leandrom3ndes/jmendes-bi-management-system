<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnsTemplateTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_text', function (Blueprint $table) {
            $table->integer('template_id')->unsigned()->after('action_template_id');
            $table->dropForeign('action_template_name_language_id_foreign');
            $table->dropForeign('action_template_name_action_template_id_foreign');
            $table->dropPrimary();
            $table->dropColumn('action_template_id');

            // Updating the identifying keys on foreign keys as the table name changed
            $table->dropForeign('action_template_name_updated_by_foreign');
            $table->dropForeign('action_template_name_deleted_by_foreign');

            $table->foreign('template_id')->references('id')->on('template')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            $table->primary(array('template_id','language_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_text', function (Blueprint $table) {
            $table->unsignedInteger('action_template_id')->after('template_id');
            $table->dropForeign(['template_id']);
            $table->dropForeign(['language_id']);
            $table->dropPrimary();
            $table->dropColumn('template_id');

            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);

            $table->foreign('action_template_id','action_template_name_language_id_foreign')->references('id')->on('template')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id','action_template_name_action_template_id_foreign')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->foreign('updated_by','action_template_name_updated_by_foreign')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by','action_template_name_deleted_by_foreign')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            $table->primary(array('action_template_id','language_id'));
        });


    }
}
