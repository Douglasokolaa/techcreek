<?php

use App\Domains\Custom\Http\Controllers\PaymentController;
use App\Domains\Custom\Http\Controllers\ProductController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);

Route::get('/admin/payments', [PaymentController::class, 'indexAdmin'])
    ->name('payments')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Payments'), route('admin.payments'));
    });

Route::get('/admin/payments/{payment}', [PaymentController::class, 'viewAdmin'])
->name('payments.show')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Payments'), route('admin.payments'));
});


Route::get('/admin/product', [ProductController::class, 'index'])
    ->name('product')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Product'), route('admin.product'));
    });

Route::patch('/admin/product/product', [ProductController::class, 'update'])
    ->name('product.update')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Product'), route('admin.product.update'));
    });
