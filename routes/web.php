<?php

Route::get('/', 'Portal\PortalController@index');
// $this->get('/', 'Portal\PortalController@index');

Auth::routes();
 
Route::get('/home', 'HomeController@index')->name('home');
