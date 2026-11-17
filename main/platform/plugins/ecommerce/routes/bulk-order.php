<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function (): void {
    Route::group(['namespace' => 'Botble\Ecommerce\Http\Controllers', 'prefix' => 'ecommerce'], function (): void {
        Route::group(['prefix' => 'bulk-orders', 'as' => 'bulk-orders.'], function (): void {
            Route::resource('', 'BulkOrderController')->except(['create', 'store'])->parameters(['' => 'bulk_order']);
        });
    });
});

Theme::registerRoutes(function (): void {
    Route::group(['namespace' => 'Botble\Ecommerce\Http\Controllers\Fronts'], function (): void {
        Route::post('bulk-order/submit', [
            'as' => 'public.bulk-order.submit',
            'uses' => 'PublicBulkOrderController@postSubmit',
        ]);
    });
});
