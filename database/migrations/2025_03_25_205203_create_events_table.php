<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedInteger('userid');
            $table->unsignedInteger('provincia');
            $table->unsignedInteger('state');
            $table->unsignedInteger('location');
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
            $table->string('alias', 120)->unique();
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
            $table->unsignedInteger('add_mainloc')->nullable();
            $table->unsignedInteger('add_subloc')->nullable();
            $table->unsignedInteger('add_loc')->nullable();
            $table->unsignedInteger('eventtype')->nullable();
            $table->unsignedInteger('branch')->nullable();
            $table->string('author', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('testimonial')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->text('rsvp_link')->nullable();
            $table->text('read_more_link')->nullable();
            $table->text('tickets_available')->nullable();
            $table->text('eventtime')->nullable();
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
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}