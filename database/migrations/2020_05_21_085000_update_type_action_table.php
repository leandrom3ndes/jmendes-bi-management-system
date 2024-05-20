<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTypeActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action', function (Blueprint $table) {
            // As laravel doesn't support changing enums, we need to drop the column and create a new one
            $table->dropColumn('type');
        });
        Schema::table('action', function (Blueprint $table) {
            $table->enum('type', ['causal_link','assign_expression', 'user_input','user_output','produce_doc','if', 'then', 'else','while','foreach','read_value','external_call'])
                ->after('action_rule_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action', function (Blueprint $table) {
            // As laravel doesn't support changing enums, we need to drop the column and create a new one
            $table->dropColumn('type');
        });
        Schema::table('action', function (Blueprint $table) {
            $table->enum('type', ['specify_data','if','then','else','while','foreach','WRITE_VALUE','READ_VALUE','PRODUCE_DOCUMENT','CLIENT_OUTPUT','EXTERNAL_CALL','C-ACT'])
                ->after('action_rule_id');
        });
    }
}
