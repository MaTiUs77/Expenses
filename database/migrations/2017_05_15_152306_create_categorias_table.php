<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('categoria', 45);
			$table->integer('root')->unsigned()->nullable()->default(0);
			$table->string('icon', 45)->nullable()->default('question-circle-o');
			$table->string('color', 45)->nullable();
			$table->integer('id_owner')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categorias');
	}

}
