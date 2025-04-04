<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventStartAtAndEventEndAtToEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->timestamp('event_start_at')->nullable()->after('existing_column'); // Replace 'existing_column' with the column after which you want to add it
            $table->timestamp('event_end_at')->nullable()->after('event_start_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn(['event_start_at', 'event_end_at']);
        });
    }
}
