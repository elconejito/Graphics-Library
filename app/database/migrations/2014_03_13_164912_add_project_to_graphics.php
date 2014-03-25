<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectToGraphics extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('graphics', function(Blueprint $table)
		{
			// add projectID to this table
			$table->integer('project_id');
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
			// remove projectID from this table
			$table->dropColumn('project_id');
		});
	}

}