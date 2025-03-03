<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	class AddLogoAltToAdminStoreTable extends Migration
	{
		/**
			* Run the migrations.
			*
			* @return void
		*/
		public function up()
		{
			Schema::table('admin_store', function (Blueprint $table) {
				//
				$table->string('logo_alt')->nullable();
			});
		}
		
		/**
			* Reverse the migrations.
			*
			* @return void
		*/
		public function down()
		{
			Schema::table('admin_store', function (Blueprint $table) {
				//
				$table->dropColumn('logo_alt');
			});
		}
	}
