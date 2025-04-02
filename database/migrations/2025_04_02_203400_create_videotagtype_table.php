<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideotagtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videotagtype', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->collation('utf8mb4_unicode_ci');
            $table->string('alias', 120)->collation('utf8mb4_unicode_ci')->index();
            $table->string('image', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('url', 100)->collation('utf8mb4_unicode_ci')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videotagtype');
    }
}
