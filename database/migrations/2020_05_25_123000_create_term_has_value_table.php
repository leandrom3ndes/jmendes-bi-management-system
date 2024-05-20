<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermHasValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_has_value', function (Blueprint $table) {
            $table->integer('term_id')->unsigned();
            $table->enum('value_type',['string','integer_number','real_number','boolean']);
            $table->string('value',512);
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');

            $table->foreign('term_id')->references('id')->on('term')->onDelete('no action')->onUpdate('no action');
            $table->primary('term_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('term_has_value');
    }
}
