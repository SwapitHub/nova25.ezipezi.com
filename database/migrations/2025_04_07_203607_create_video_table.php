<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id(); // id INT PRIMARY KEY AUTO_INCREMENT
            $table->string('name', 100);
            $table->integer('userid');
            $table->integer('provincia');
            $table->integer('state');
            $table->integer('location');
            $table->text('introduction')->nullable();
            $table->text('content')->nullable();
            $table->text('embedcode')->nullable();
            $table->text('contact')->nullable();
            $table->text('street1')->nullable();
            $table->text('street2')->nullable();
            $table->text('street3')->nullable();
            $table->string('longitude', 100)->nullable();
            $table->string('lattitude', 255)->nullable();
            $table->string('startdate', 100)->nullable();
            $table->string('expire', 255)->nullable();
            $table->string('alias', 120)->index();
            $table->string('image', 255)->nullable();
            $table->string('imagealt', 255)->nullable();
            $table->string('tags', 255)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('add_regname', 100)->nullable();
            $table->string('add_fname', 100)->nullable();
            $table->string('add_lname', 100)->nullable();
            $table->string('add_email', 100)->nullable();
            $table->string('add_postal1', 100)->nullable();
            $table->string('add_postal2', 100)->nullable();
            $table->string('add_postal3', 100)->nullable();
            $table->string('add_postcode', 100)->nullable();
            $table->string('add_busiphone', 15)->nullable();
            $table->string('add_homephone', 15)->nullable();
            $table->string('add_cellphone', 15)->nullable();
            $table->text('notes')->nullable();
            $table->integer('add_mainloc')->nullable();
            $table->integer('add_subloc')->nullable();
            $table->integer('add_loc')->nullable();
            $table->integer('videotype')->nullable();
            $table->integer('branch')->nullable();
            $table->string('author', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('testimonial')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->timestamps();
            $table->tinyInteger('fprop')->nullable();
            $table->tinyInteger('fnews')->nullable();
            $table->tinyInteger('fproduct')->nullable();
            $table->tinyInteger('fservice')->nullable();
            $table->tinyInteger('faccommo')->nullable();
            $table->tinyInteger('faport')->nullable();
            $table->tinyInteger('fablog')->nullable();
            $table->string('accorder', 15)->nullable();
            $table->string('sorder', 15)->nullable();
            $table->string('proorder', 15)->nullable();
            $table->string('norder', 15)->nullable();
            $table->string('porder', 15)->nullable();
            $table->string('portorder', 15)->nullable();
            $table->string('blogorder', 15)->nullable();
            $table->tinyInteger('tott')->nullable();
            $table->tinyInteger('aa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
}
