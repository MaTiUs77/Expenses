<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCuentasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuentas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cuenta', 45);
			$table->smallInteger('orden')->unsigned();
			$table->string('color', 8)->default('FF0000');
			$table->integer('id_tipo_cuenta')->nullable()->default(0);
			$table->integer('debito_id_cuenta')->unsigned();
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
		Schema::drop('cuentas');
	}

}
