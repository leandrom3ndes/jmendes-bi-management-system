<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new CreateOperatorTable)->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        (new CreateOperatorTable)->up();
        Schema::table('operator', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
    }
}
