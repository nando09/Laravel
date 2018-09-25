<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Balance extends Model
{
	//Quando nos não usamos o $table->timestamps(); precisamos fazer isso
	public $timestamps = false;

	public function deposit(float $value) : Array
	{
		DB::beginTransaction();

		$totalBefore = $this->amount ? $this->amount : 0;
		$this->amount += number_format($value, 2, '.', '');
		$deposit = $this->save();


		$historic = auth()->user()->historics()->create([
			'type' 			=> 'I',
			'amount' 		=> $value,
			'total_before' 	=> $totalBefore,
			'total_after' 	=> $this->amount,
			'date' 			=> date('Ymd'),
		]);

		if ($deposit && $historic) {
			DB::commit();

			return[
				'sucess' => true,
				'message' => 'Sucesso ao carregar!'
			];
		}else{
			DB::rollback();
			return[
				'sucess' => false,
				'message' => 'Falha ao carregar!'
			];
		}

	}
}
