<?php
Route::group(['middleware' => 'web'], function () {
	Route::get('login', 'Zarkasih\Zmember\ZmemberController@showLogin');
	Route::get('login/{channel}', 'Zarkasih\Zmember\ZmemberController@socialLogin');
	Route::get('login/{channel}/callback', 'Zarkasih\Zmember\ZmemberController@socialCallback');
	Route::post('login', 'Zarkasih\Zmember\ZmemberController@doLogin');
	Route::get('register', 'Zarkasih\Zmember\ZregisterController@showRegister');
	Route::post('register', 'Zarkasih\Zmember\ZregisterController@doRegister');
});