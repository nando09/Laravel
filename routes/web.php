<?php

// Criando um grupo para analisar se esta dentro dos conformes para acessar essa barra
$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){

	// Route::get('admin, 'Admin\AdminController@index');
	$this->get('/', 'AdminController@index')->name('admin.home');
	$this->get('balance', 'BalanceController@index')->name('admin.balance');
});


// // Route::get('/', 'Portal\PortalController@index');
// $this->get('/', 'Portal\PortalController@index')->name('home');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
