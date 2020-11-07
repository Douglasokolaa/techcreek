<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

// Route::get('/', [HomeController::class, 'index'])
//     ->name('index')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Home'), route('frontend.index'));
//     });

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('Administrator')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('frontend.user.dashboard');
    }
    return redirect()->route('frontend.custom.payments');
})->name('index');

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
