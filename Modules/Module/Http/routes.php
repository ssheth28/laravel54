<?php

Route::group(['domain' => '{company}.'.config('config-variables.app.domain')], function () {
    Route::group(
        [
            'prefix'     => LaravelLocalization::setLocale(),
            'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect'],
        ],
        function () {
            Route::group(
            [
                'prefix'     => UserRole::setUserRole(),
                'middleware' => ['roleSessionRedirect'],
            ],
            function () {
                Route::group(['middleware' => ['verifycompany'], 'prefix' => 'admin', 'namespace' => 'Modules\Module\Http\Controllers'], function () {
                    Route::resource('modules', 'ModuleController');
                    Route::post('/getModuleData', 'ModuleController@getModuleData');
                    Route::post('generateModuleUrl', 'ModuleController@generateModuleUrl');

                    Route::resource('pages', 'PageController');
                    Route::post('/getPageData', 'PageController@getPageData');
                    Route::post('generatePageUrl', 'PageController@generatePageUrl');
                });
            });
        });
});
