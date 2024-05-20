<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateToastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('template_toast', function (Blueprint $table) {
            $table->integer('template_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->enum('class',['success','information','warning','error','custom']);
            $table->char('colour',7)->nullable();
            $table->string('title_text', 512)->nullable();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            $table->foreign('template_id')->references('id')->on('template')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('template_id', 'language_id'),'tt_primary_keys');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('template_toast');
    }
}
