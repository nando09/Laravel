<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;


class BalanceController extends Controller
{
	//
	public function index(){
		// dd(auth()->user()->balance()->get());
		$balance = auth()->user()->balance;
		$amount = $balance ? $balance->amount : 0;

		return view('admin.balance.index', compact('amount'));
	}

	public function deposit(){
		return view('admin.balance.deposit');
	}

	public function depositStore(MoneyValidationFormRequest $request){
		// dd($request->value);
		// $balance->deposit($request->value);
		$balance = auth()->user()->balance()->firstOrCreate([]);
		$response = $balance->deposit($request->valor);

		if ($response['sucess'])
			return redirect()
				->route('admin.balance')
				->with('sucess', $response['message']);

		return redirect()
			->back()
			->with('error', $response['message']);
	}

	public function withdraw(){
		return view('admin.balance.withdraw', compact('amount'));
	}

	public function withdrawStore(MoneyValidationFormRequest $request){
		// dd($request->all());
		// dd($request->value);
		// $balance->deposit($request->value);
		$balance = auth()->user()->balance()->firstOrCreate([]);
		$response = $balance->withdraw($request->valor);

		if ($response['sucess'])
			return redirect()
				->route('admin.balance')
				->with('sucess', $response['message']);

		return redirect()
			->back()
			->with('error', $response['message']);
	}
}
