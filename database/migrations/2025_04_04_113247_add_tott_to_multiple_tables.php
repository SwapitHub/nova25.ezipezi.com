<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTottToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $tables = ['newblog', 'service', 'events', 'property', 'accommodation','gallary'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->tinyInteger('tott')->nullable()->after('fablog');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $tables = ['newblog', 'service', 'events', 'property', 'accommodation'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('tott');
            });
        }
    }
}
