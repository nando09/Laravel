<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// quando rodar o seeder, chama essa classe da linha de baixo
        $this->call(UsersTableSeeder::class);
    }
}
