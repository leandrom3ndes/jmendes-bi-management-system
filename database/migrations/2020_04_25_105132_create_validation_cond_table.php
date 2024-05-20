<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidationCondTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

          Schema::create('validation_cond', function (Blueprint $table) {
              $table->increments('id');
              $table->enum('type', ['required', 'isNumber', 'isInteger', 'equalTo', 'maxWordLength', 'lessEqual', 'higherEqual', 'higherThan', 'lessThan', 'minLength', 'belongsRange', 'maxLength', 'minWordLength', 'hasCharacter', 'regExpression', 'hasWord', 'isEmail', 'isURL', 'customValidation']);
              $table->integer('action_prop_id')->unsigned();
              $table->string('param_1', 256)->nullable();
              $table->string('param_2', 256)->nullable();
              $table->longText('custom_validation')->nullable();
              $table->boolean('negative');
              $table->integer('updated_by')->nullable()->unsigned();
              $table->integer('deleted_by')->nullable()->unsigned();
              $table->timestamps();
              $table->softDeletes();

              $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
              $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

              $table->foreign('action_prop_id')->references('id')->on('action_prop')->onDelete('no action')->onUpdate('no action');
          });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('validation_cond');
    }
}
