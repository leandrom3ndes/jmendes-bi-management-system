<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('query', function (Blueprint $table) {
            $table->dropForeign(['ent_type_id']);
            $table->dropColumn(['ent_type_id','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('query', function (Blueprint $table) {
            $table->unsignedInteger('ent_type_id')
                ->after('id');
            $table->string('name', 512)
                ->after('value_type');

            $table->foreign('ent_type_id')->references('id')->on('ent_type')->onDelete('no action')->onUpdate('no action');
        });
    }
}
