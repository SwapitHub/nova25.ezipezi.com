<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_slider', function (Blueprint $table) {
            $table->id(); // id (Primary, Auto Increment, Unsigned)
            $table->string('name',120); // id (Primary, Auto Increment, Unsigned)
            $table->text('keyword'); // id (Primary, Auto Increment, Unsigned)
            $table->text('description'); // image (nullable)
            $table->string('alias', 120)->index(); // alias (indexed, not nullable)
            $table->integer('parent')->nullable()->default(0); // parent (default 0)
            $table->integer('top')->nullable()->default(0); // top (nullable, default 0)
            $table->tinyInteger('status')->default(0); // status (default 0)
            $table->tinyInteger('sort')->default(0); // sort (default 0)
            $table->integer('page')->nullable(); // page (not nullable)
            $table->date('startdate')->nullable(); // startdate (nullable)
            $table->date('expire')->nullable(); // expire (nullable)
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_slider');
    }
}
