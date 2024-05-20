<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ent_type_id')->nullable()->unsigned();
            $table->integer('action_id')->nullable()->unsigned();
            $table->enum('origin_type', ['input','ar_assign','cur_form_comp']);
            $table->enum('value_type', ['text', 'bool', 'int', 'double', 'enum', 'date', 'time', 'prop_ref', 'file'])->comment('text, int, double, boolean, enum');
            $table->enum('form_field_type', ['text','textbox','number','radio','checkbox','selectbox','file', 'date', 'time']);
            $table->integer('unit_type_id')->nullable()->unsigned();
            $table->integer('form_field_order')->comment('order in which form fields will be shown');
            $table->integer('mandatory')->comment('1 if property is mandatory for its parent, 0 if not');
            $table->enum('state', ['active','inactive']);
            $table->integer('fk_property_id')->nullable()->unsigned();
            $table->string('form_field_size', 64)->nullable();
            $table->boolean('can_edit');
            $table->integer('cur_form_compute_code_id')->nullable()->unsigned();
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
        Schema::drop('property');
    }
}
