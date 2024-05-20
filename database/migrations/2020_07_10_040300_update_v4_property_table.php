<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateV4PropertyTable extends Migration
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
            $table->dropColumn('cur_form_compute_code_id');
            $table->dropColumn('can_edit');
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
            $table->boolean('can_edit');
            $table->integer('cur_form_compute_code_id')->nullable()->unsigned();
        });
    }
}
