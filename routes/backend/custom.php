<?php

use App\Domains\Custom\Http\Controllers\PaymentController;
use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);

Route::get('/admin/payments', [PaymentController::class, 'indexAdmin'])
    ->name('payments')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Payments'), route('admin.payments'));
    });
