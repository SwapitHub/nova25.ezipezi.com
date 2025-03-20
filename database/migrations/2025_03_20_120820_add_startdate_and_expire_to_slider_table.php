<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartdateAndExpireToSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->date('startdate')->nullable()->after('image_alt'); // Replace 'existing_column' with the actual column after which you want to add it.
            $table->date('expire')->nullable()->after('startdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn(['startdate', 'expire']);
        });
    }
}
