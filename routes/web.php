<?php

// Criando um grupo para analisar se esta dentro dos conformes para acessar essa barra
$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){

	$this->get('historic', 'BalanceController@historic')->name('admin.historic');

	$this->post('balance/confirm.transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');
	$this->post('balance/transfer', 'BalanceController@transferStore')->name('transfer.store');
	$this->get('balance/transfer', 'BalanceController@transfer')->name('balance.transfer');

	$this->post('balance/withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
	$this->get('balance/withdraw', 'BalanceController@withdraw')->name('balance.withdraw');

	$this->post('balance/deposit', 'BalanceController@depositStore')->name('deposit.store');
	$this->get('balance/deposit', 'BalanceController@deposit')->name('balance.deposit');

	// Route::get('admin, 'Admin\AdminController@index');
	$this->get('/', 'AdminController@index')->name('admin.home');
	$this->get('balance', 'BalanceController@index')->name('admin.balance');
});


// // Route::get('/', 'Portal\PortalController@index');
// $this->get('/', 'Portal\PortalController@index')->name('home');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
