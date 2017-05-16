<?php

Route::group(['domain' => '{company}.'.config('config-variables.app.domain')], function () {
    Route::group(
        [
            'prefix'     => LaravelLocalization::setLocale(),
            'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect'],
        ],
        function () {        	
			Route::group(['middleware' => ['web', 'verifycompany'], 'prefix' => 'admin', 'namespace' => 'Modules\Module\Http\Controllers'], function () {
			    Route::resource('modules', 'ModuleController');
                Route::post('/getModuleData', 'ModuleController@getModuleData');
                Route::post('generateModuleUrl', 'ModuleController@generateModuleUrl');
			});
		});
});