<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertDataIntoEventtabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // Insert data into eventtab table
         DB::table('eventtab')->insert([
            [
                'id' => 1,
                'name' => 'Contact Details',
                'alias' => 'contact-details',
                'image' => null,
                'url' => null,
                'status' => 1,
                'sort' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Description',
                'alias' => 'description',
                'image' => null,
                'url' => null,
                'status' => 1,
                'sort' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Additional Event Information',
                'alias' => 'additional-event-information',
                'image' => null,
                'url' => null,
                'status' => 1,
                'sort' => 3,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('eventtab')->whereIn('id', [1, 2, 3])->delete();
    }
}
