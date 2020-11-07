<?php

use App\Domains\Custom\Http\Controllers\PaymentController;
use App\Domains\Custom\Http\Controllers\ProductController;
use Tabuna\Breadcrumbs\Trail;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */

Route::group(['as' => 'custom.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('payments', [PaymentController::class, 'index'])
        ->middleware('is_user')
        ->name('payments')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Payments'), route('frontend.custom.payments'));
        });

    Route::get('products', [ProductController::class, 'index'])
    ->middleware('is_user')
    ->name('products')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Products'), route('frontend.custom.products'));
    });
});
