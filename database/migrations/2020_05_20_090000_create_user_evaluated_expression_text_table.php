<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEvaluatedExpressionTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_evaluated_expression_text', function (Blueprint $table) {
            $table->integer('user_evaluated_expression_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('expression_name', 512);
            $table->string('expression_text', 512);
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            // second parameter in foreign() and primary() is an identifier name because otherwise it would be too long
            $table->foreign('user_evaluated_expression_id','uee_id_foreign')->references('id')->on('user_evaluated_expression')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('user_evaluated_expression_id', 'language_id'),'uee_primary_keys');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_evaluated_expression_text');
    }
}
