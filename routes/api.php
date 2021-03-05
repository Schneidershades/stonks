<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'user', 'namespace' => 'Api\User'], function(){
		Route::post('register', 'UserController@register');
    	Route::post('login', 'UserController@login');
    	Route::post('logout', 'UserController@logout');
        Route::get('profile', 'UserController@profile');
        Route::post('update', 'UserController@updateUser');
	});

	Route::group(['prefix' => 'transaction', 'namespace' => 'Api\Transaction'], function(){
		Route::post('deposit', 'DepositController@store');
		Route::post('withdrawal', 'WithdrawalController@store');
		Route::post('transfer', 'TransferController@store');
		Route::get('transactions', 'TransactionController@index');
	});
});
