<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermHasPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_has_property', function (Blueprint $table) {
            $table->integer('term_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            $table->foreign('term_id')->references('id')->on('term')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('term_id', 'property_id'),'thp_primary_keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('term_has_property');
    }
}
