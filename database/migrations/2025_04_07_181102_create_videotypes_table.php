<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideotypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videotype', function (Blueprint $table) {
            $table->id(); // id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 100); // name VARCHAR(100) NOT NULL
            $table->string('alias', 120)->index(); // alias VARCHAR(120) NOT NULL
            $table->string('image', 255)->nullable(); // image VARCHAR(255) NULL
            $table->string('url', 100)->nullable(); // url VARCHAR(100) NULL
            $table->tinyInteger('status')->default(0); // status TINYINT(4) DEFAULT 0
            $table->tinyInteger('sort')->default(0); // sort TINYINT(4) DEFAULT 0
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videotype');
    }
}
