<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	class AddColumnsToHomeContentTable extends Migration
	{
		/**
			* Run the migrations.
			*
			* @return void
		*/
		public function up()
		{
			Schema::table('home_content', function (Blueprint $table) {
				//
				$table->string('aboutus_img1_alt')->nullable();
				$table->string('aboutus_img2_alt')->nullable();
				$table->string('gallary_img1_alt')->nullable();
				$table->string('gallary_img3_alt')->nullable();
				$table->string('gallary_img4_alt')->nullable();
				$table->string('gallary_img5_alt')->nullable();
			});
		}
		
		/**
			* Reverse the migrations.
			*
			* @return void
		*/
		public function down()
		{
			Schema::table('home_content', function (Blueprint $table) {
				//
				$table->dropColumn('aboutus_img1_alt');
				$table->dropColumn('aboutus_img2_alt');
				$table->dropColumn('gallary_img1_alt');
				$table->dropColumn('gallary_img3_alt');
				$table->dropColumn('gallary_img4_alt');
				$table->dropColumn('gallary_img5_alt');
			});
		}
	}
