<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

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

	public function withdraw(float $value) : Array
	{
		if ($this->amount < $value)
			return[
				'success' => false,
				'message' => 'Saldo insuficiente'
			];

		DB::beginTransaction();

		$totalBefore = $this->amount ? $this->amount : 0;
		$this->amount -= number_format($value, 2, '.', '');
		$withdraw = $this->save();

		$historic = auth()->user()->historics()->create([
			'type' 			=> 'O',
			'amount' 		=> $value,
			'total_before' 	=> $totalBefore,
			'total_after' 	=> $this->amount,
			'date' 			=> date('Ymd'),
		]);

		if ($withdraw && $historic) {
			DB::commit();

			return[
				'sucess' => true,
				'message' => 'Sucesso ao sacar!'
			];
		}else{
			DB::rollback();
			return[
				'sucess' => false,
				'message' => 'Falha ao sacar!'
			];
		}

	}

	public function transfer(float $value, User $sender) : Array
	{
		if ($this->amount < $value)
			return[
				'success' => false,
				'message' => 'Saldo insuficiente'
			];

		DB::beginTransaction();
		/**
				Atualizar o próprio saldo
		**/
		$totalBefore = $this->amount ? $this->amount : 0;
		$this->amount -= number_format($value, 2, '.', '');
		$transfer = $this->save();

		$historic = auth()->user()->historics()->create([
			'type' 					=> 'T',
			'amount' 				=> $value,
			'total_before' 			=> $totalBefore,
			'total_after' 			=> $this->amount,
			'date' 					=> date('Ymd'),
			'user_id_transaction'	=> $sender->id
		]);

		/**
				Atualizar saldo do recebedor
		**/
		$senderBalance = $sender->balance()->firstOrCreate([]);
		$totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
		$senderBalance->amount += number_format($value, 2, '.', '');
		$transferSender = $senderBalance->save();

		$historicSender = $sender->historics()->create([
			'type' 					=> 'I',
			'amount' 				=> $value,
			'total_before' 			=> $totalBeforeSender,
			'total_after' 			=> $senderBalance->amount,
			'date' 					=> date('Ymd'),
			'user_id_transaction'	=> auth()->user()->id,
		]);


		if ($transfer && $historic && $transferSender) {
			DB::commit();

			return[
				'sucess' => true,
				'message' => 'Sucesso ao Transferir!'
			];
		}

		DB::rollback();
		return[
			'sucess' => false,
			'message' => 'Falha ao sacar!'
		];
	}
}
