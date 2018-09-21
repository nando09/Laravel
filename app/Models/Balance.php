<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
	//Quando nos não usamos o $table->timestamps(); precisamos fazer isso
	public $timestamps = false;

	public function deposit(float $value) : Array
	{

		$this->amount += number_format($value, 2, '.', '');
		$deposit = $this->save();

		if ($deposit) {
			return[
				'sucess' => true,
				'message' => 'Sucesso ao carregar!'
			];
		}

		return[
			'sucess' => false,
			'message' => 'Falha ao carregar!'
		];
	}
}
