<?php
Route::group(['middleware' => 'web'], function () {
	Route::get('login', 'Muhzar\Zmember\ZmemberController@showLogin');
	Route::get('login/{channel}', 'Muhzar\Zmember\ZmemberController@socialLogin');
	Route::get('login/{channel}/callback', 'Muhzar\Zmember\ZmemberController@socialCallback');
	Route::post('login', 'Muhzar\Zmember\ZmemberController@doLogin');
	Route::get('register', 'Muhzar\Zmember\ZregisterController@showRegister');
	Route::post('register', 'Muhzar\Zmember\ZregisterController@doRegister');
});