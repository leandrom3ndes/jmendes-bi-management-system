<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkedActionsActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action', function (Blueprint $table) {
            $table->integer('prev_action_id')->unsigned()->after('type')->nullable();
            $table->integer('next_action_id')->unsigned()->after('prev_action_id')->nullable();
            $table->dropColumn('order');
            $table->foreign('prev_action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('next_action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action', function (Blueprint $table) {
            $table->dropForeign(['prev_action_id']);
            $table->dropForeign(['next_action_id']);
            $table->dropColumn(['prev_action_id','next_action_id']);
            $table->integer('order')->unsigned()->after('type');
        });
    }
}
