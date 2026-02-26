<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('Grades', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('Name', 50);
			$table->string('Notes', 50)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Grades');
	}
}