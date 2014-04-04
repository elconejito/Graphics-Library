<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAgenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('agencies', function(Blueprint $table)
		{
			//
			$table->string('name')->unique();
			$table->string('shortname');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('agencies', function(Blueprint $table)
		{
			//
			$table->dropColumn('name', 'shortname');
		});
	}

}