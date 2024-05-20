<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCurFormComputeCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new CreateCurFormComputeCodeTable)->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        (new CreateCurFormComputeCodeTable)->up();
        Schema::table('cur_form_compute_code', function(Blueprint $table) {
            $table->foreign('ar_condition_id')->references('id')->on('ar_condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

    }
}

