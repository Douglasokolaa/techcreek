<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Custom\Models\Payment;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        dd(Payment::search('')->paginate(10));
        return view('backend.dashboard');
    }
}
