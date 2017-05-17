<?php

Route::group(['domain' => '{company}.'.config('config-variables.app.domain')], function () {
    Route::group(
        [
            'prefix'     => LaravelLocalization::setLocale(),
            'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect'],
        ],
        function () {
            Route::group(['middleware' => ['web', 'verifycompany'], 'prefix' => 'admin', 'namespace' => 'Modules\Widget\Http\Controllers'], function () {
                Route::resource('widgets', 'WidgetController');
                Route::post('/getWidgetData', 'WidgetController@getWidgetData');
            });
        });
});
