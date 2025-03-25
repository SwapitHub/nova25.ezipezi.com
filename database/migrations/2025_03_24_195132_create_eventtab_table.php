<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventtabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventtab', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment, UNSIGNED INT)
            $table->string('name', 100);
            $table->string('alias', 120)->index(); // Indexed alias field
            $table->string('image', 255)->nullable();
            $table->string('url', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventtab');
    }
}
