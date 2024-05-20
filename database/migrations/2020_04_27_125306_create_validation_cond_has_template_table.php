<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidationCondHasTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validation_cond_has_template', function (Blueprint $table) {
              $table->integer('validation_cond_id')->unsigned();
              $table->integer('template_id')->unsigned();
              $table->integer('updated_by')->nullable()->unsigned();
              $table->integer('deleted_by')->nullable()->unsigned();
              $table->timestamps();
              $table->softDeletes();

              $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
              $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

              $table->foreign('template_id')->references('id')->on('template')->onDelete('no action')->onUpdate('no action');
              $table->foreign('validation_cond_id')->references('id')->on('validation_cond')->onDelete('no action')->onUpdate('no action');
              $table->primary(array('validation_cond_id', 'template_id'),'vcht_primary_keys');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('validation_cond_has_template');
    }
}
