<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('balances', function (Blueprint $table) {
			$table->increments('id');
			// Essa informação e para saber quando esta sendo alterado e quando esta sendo insere, se nao trabalhar precisar ir no model dele que é o app/Models/balances.php
			// $table->timestamps();

			// criando uma coluna user_id e definindo como chave estrangeira
			$table->integer('user_id')->unsigned();
			//Definindo como chave estrangeira da coluna user_id, referente o id da tabale users, quando deletar um id automaticamento deletar o user_id 
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			// Criando uma coluna para pegar o saldo do usuario, um valor double com 10 numero e 2 depois do virgula
			$table->double('amount', 10,2)->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('balances');
	}
}
