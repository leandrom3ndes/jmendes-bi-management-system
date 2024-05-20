<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_type', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('state', ['active', 'inactive']);
            $table->integer('process_type_id')->unsigned();
			$table->boolean('init_proc');
            $table->integer('executer')->unsigned();
            $table->boolean('auto_activate')->unsigned();
            $table->string('freq_activate', 45)->nullable();
            $table->time('when_activate')->nullable();
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
        Schema::drop('transaction_type');
    }
}
