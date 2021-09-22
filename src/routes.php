<?php

#IPTV Routes

Route::group([
    'middleware' => ['web', 'iptv_locale'],
	],
	function(){
        Route::prefix('plan')->group(function () {
            Route::get('/list', 'FelipeMateus\IPTVCustomers\Controllers\PlanController@list')->name('list_plan');

            Route::get('/add', 'FelipeMateus\IPTVCustomers\Controllers\PlanController@new')->name('add_plan');
            Route::post('/add', 'FelipeMateus\IPTVCustomers\Controllers\PlanController@create')->name('create_plan');

            Route::get('/{id}', 'FelipeMateus\IPTVCustomers\Controllers\PlanController@show')->name('show_plan');

            Route::post('/{id}', 'FelipeMateus\IPTVCustomers\Controllers\PlanController@update')->name('update_plan');
            Route::get('/del/{id}', 'FelipeMateus\IPTVCustomers\Controllers\PlanController@delete')->name('delete_plan');
        });


        Route::prefix('customer')->group(function () {
            Route::get('list', 'FelipeMateus\IPTVCustomers\Controllers\CustomerController@list')->name('list_customer');
            Route::get('add', 'FelipeMateus\IPTVCustomers\Controllers\CustomerController@new')->name('add_customer');
            Route::post('add', 'FelipeMateus\IPTVCustomers\Controllers\CustomerController@create')->name('create_customer');
            Route::get('/{id}', 'FelipeMateus\IPTVCustomers\Controllers\CustomerController@show')->name('show_customer');
            Route::post('/{id}', 'FelipeMateus\IPTVCustomers\Controllers\ChannelController@update')->name('update_customer');
            Route::get('/del/{id}', 'FelipeMateus\IPTVCustomers\Controllers\CustomerController@delete')->name('delete_customer');
        });
    }
);
