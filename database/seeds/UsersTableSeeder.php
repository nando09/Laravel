<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Vamos criar um User, usuario.
		User::create([
			// passando o nome para o user em forma de array
			'name'		=> 'Fernando Batista',
			// passando o email
			'email'		=> 'nando.online@live.com',
			// passando a senha em bcrypt um criptografia do laravel
			'password'	=> bcrypt('sinaneva')
		]);
	}
}


// para esse seeder funciona precisa mexer no DatabaSeseeder.php
