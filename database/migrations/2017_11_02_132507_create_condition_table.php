<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condition', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('query_id')->unsigned();
            $table->integer('operator_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('value_id')->nullable()->unsigned();
            $table->string('value', 512)->nullable();
            $table->integer('id_values')->nullable();
            $table->string('table_type', 5);
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condition');
    }
}
