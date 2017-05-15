<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movimientos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_cuenta')->unsigned()->index();
			$table->integer('id_categoria')->unsigned();
			$table->string('moneda', 4)->default('ARS');
			$table->float('monto', 10, 0);
			$table->string('modo');
			$table->text('nota', 65535)->nullable();
			$table->string('modo_pago')->default('E');
			$table->integer('transfer_id_cuenta')->unsigned()->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movimientos');
	}

}
