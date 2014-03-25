<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGraphicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('graphics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('control_number',20)->unique();
            $table->string('title');
            $table->string('path');
            $table->string('file_name');
			$table->timestamps();
            $table->softDeletes();
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('graphics');
	}

}
