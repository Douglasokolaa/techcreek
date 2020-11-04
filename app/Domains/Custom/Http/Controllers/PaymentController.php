<?php

namespace App\Domains\Custom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.payments.index');
    }

    public function indexAdmin()
    {
        return view('backend.payments.index');
    }
    
}
