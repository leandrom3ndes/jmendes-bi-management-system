<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiKnowageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bi_knowage_settings', function (Blueprint $table) {
            $table->integer('bi_knowage_id');
            $table->enum('display_toolbar', ['true', 'false']);
            $table->enum('display_sliders', ['true', 'false']);
            $table->enum('reset_parameters', ['true', 'false']);
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
        Schema::dropIfExists('bi_knowage_settings');
    }
}
