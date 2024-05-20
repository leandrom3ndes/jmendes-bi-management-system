<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            // Drop columns
            $table->dropColumn('form_field_type');
            $table->dropColumn('form_field_order');
            $table->dropColumn('mandatory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->enum('form_field_type', ['text','textbox','number','radio','checkbox','selectbox','file', 'date', 'time']);
            $table->integer('form_field_order')->comment('order in which form fields will be shown');
            $table->integer('mandatory')->comment('1 if property is mandatory for its parent, 0 if not');
        });
    }
}
