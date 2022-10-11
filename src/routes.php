<?php

#IPTV Routes
Route::group([
    'prefix' => 'client/m3u8',
    'middleware' => ['api','client'],
	],
    function(){
         Route::get('/{slug}',"Tschope\IPTVCustomers\Controllers\CustomerChannelsM3UController@show")->name("client-playlist");
    });

Route::group([
    'middleware' => ['web', 'iptv_locale'],
	],
	function(){
        Route::prefix('plan')->group(function () {
            Route::get('/list', 'Tschope\IPTVCustomers\Controllers\PlanController@list')->name('list_plan');

            Route::get('/add', 'Tschope\IPTVCustomers\Controllers\PlanController@new')->name('add_plan');
            Route::post('/add', 'Tschope\IPTVCustomers\Controllers\PlanController@create')->name('create_plan');

            Route::get('/{id}', 'Tschope\IPTVCustomers\Controllers\PlanController@show')->name('show_plan');
            Route::post('/{id}', 'Tschope\IPTVCustomers\Controllers\PlanController@update')->name('update_plan');

            Route::get('/del/{id}', 'Tschope\IPTVCustomers\Controllers\PlanController@delete')->name('delete_plan');

            Route::post('/{plan_id}/group/add', 'Tschope\IPTVCustomers\Controllers\PlanGroupController@add')->name('add_group_to_plan');
            Route::post('/{plan_id}/group/delete', 'Tschope\IPTVCustomers\Controllers\PlanGroupController@delete')->name('delete_group_to_plan');

        });


        Route::prefix('customer')->group(function () {
            Route::get('list', 'Tschope\IPTVCustomers\Controllers\CustomerController@list')->name('list_customer');
            Route::get('add', 'Tschope\IPTVCustomers\Controllers\CustomerController@new')->name('add_customer');
            Route::post('add', 'Tschope\IPTVCustomers\Controllers\CustomerController@create')->name('create_customer');
            Route::get('/{id}', 'Tschope\IPTVCustomers\Controllers\CustomerController@show')->name('show_customer');
            Route::post('/{id}', 'Tschope\IPTVCustomers\Controllers\CustomerController@update')->name('update_customer');
            Route::get('/del/{id}', 'Tschope\IPTVCustomers\Controllers\CustomerController@delete')->name('delete_customer');

            Route::post('/{customer_id}/plan_additional/add', 'Tschope\IPTVCustomers\Controllers\CustomerPlanAdditionalController@add')->name('add_additional');
            Route::post('/{customer_id}/plan_additional/del', 'Tschope\IPTVCustomers\Controllers\CustomerPlanAdditionalController@del')->name('del_additional');


            Route::get('/{customer_id}/invoces/new', 'Tschope\IPTVCustomers\Controllers\InvoceController@new')->name('new_customer');
            Route::post('/{customer_id}/invoces/new', 'Tschope\IPTVCustomers\Controllers\InvoceController@create')->name('create_customer');
            Route::post('/{customer_id}/invoces/{id}/pay', 'Tschope\IPTVCustomers\Controllers\InvoceController@pay')->name('pay_customer');
            Route::post('/{customer_id}/invoces/{id}/cancel', 'Tschope\IPTVCustomers\Controllers\InvoceController@cancel')->name('cancel_customer');

        });

        //Route::get('/pay/{cod}/{invoce_id}', 'Tschope\IPTVCustomers\Controllers\PayController@checkout')->name('pay');
    }
);
