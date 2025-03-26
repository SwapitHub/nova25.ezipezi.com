<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDescriptionTypeInSliderDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slider_description', function (Blueprint $table) {
            $table->text('description')->change(); // Change VARCHAR to TEXT
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider_description', function (Blueprint $table) {
            $table->string('description', 255)->change(); // Revert back to VARCHAR(255)
        });
    }
}
