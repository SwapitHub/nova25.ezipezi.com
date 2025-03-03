<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGallaryImg2AltToHomeContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_content', function (Blueprint $table) {
            //
				 $table->string('gallary_img2_alt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_content', function (Blueprint $table) {
            //
			$table->dropColumn('gallary_img2_alt');
        });
    }
}
