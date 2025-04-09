<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video', function (Blueprint $table) {
            $table->text('audience_type')->nullable();
            $table->string('venue')->nullable();
            $table->text('read_more_link')->nullable(); 
            $table->text('watch_now_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video', function (Blueprint $table) {
            $table->dropColumn([
                'audience_type',
                'venue',
                'read_more_link',
                'watch_now_link',
            ]);
        });
    }
}
