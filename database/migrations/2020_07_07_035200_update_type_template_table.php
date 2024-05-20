<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTypeTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // As 2 different functions or it will give an error saying that column type already exists in the 2nd instructions
        Schema::table('template', function (Blueprint $table) {
            // As laravel doesn't support changing enums, we need to drop the column and create a new one
            $table->dropColumn('type');
        });
        Schema::table('template', function (Blueprint $table) {
            // Add the new type column with the new enums
            $table->enum('type',['modal','toast','validation_warning'])
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
        Schema::table('template', function (Blueprint $table) {
            // As laravel doesn't support changing enums, we need to drop the column and create a new one
            $table->dropColumn('type');
        });
        Schema::table('template', function (Blueprint $table) {
            // Add the new type column with the new enums
            $table->enum('type',['modal','toast','form_before','form_after','form_field', 'validation_warning'])
                ->after('id');
        });
    }
}
