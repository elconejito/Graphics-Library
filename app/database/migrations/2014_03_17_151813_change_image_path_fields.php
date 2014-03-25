<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeImagePathFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('graphics', function(Blueprint $table)
		{
			//
            $table->renameColumn('path','image');
            $table->dropColumn('file_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('graphics', function(Blueprint $table)
		{
			//
            $table->renameColumn('image','path');
            $table->string('file_name');
		});
	}

}