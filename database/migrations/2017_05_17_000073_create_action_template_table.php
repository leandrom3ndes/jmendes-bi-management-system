	<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_template', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('action_id')->unsigned();
            $table->enum('type', ['modal','toast', 'form_before', 'form_after', 'form_field']);
            $table->integer('property_id')->nullable()->unsigned();
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
        Schema::drop('action_template');
    }
}