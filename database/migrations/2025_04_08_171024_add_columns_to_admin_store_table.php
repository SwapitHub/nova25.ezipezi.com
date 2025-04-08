<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAdminStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_store', function (Blueprint $table) {
            $table->text('section_heading1')->nullable();
            $table->text('section_heading2')->nullable();
            $table->text('desc_section_heading1')->nullable();
            $table->text('desc_section_heading2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_store', function (Blueprint $table) {
            $table->dropColumn(['section_heading1', 'section_heading2', 'desc_section_heading1','desc_section_heading2']);
        });
    }
}
