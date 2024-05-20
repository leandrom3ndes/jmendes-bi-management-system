<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValueTypeQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('query', function (Blueprint $table) {
            $table->enum('value_type',['string','integer_number','real_number','boolean'])
                ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('query', function (Blueprint $table) {
            $table->dropColumn('value_type');
        });
    }
}
