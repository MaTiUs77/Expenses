<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMonedasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('monedas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('moneda', 45);
			$table->smallInteger('compra')->nullable();
			$table->smallInteger('venta')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('monedas');
	}

}
