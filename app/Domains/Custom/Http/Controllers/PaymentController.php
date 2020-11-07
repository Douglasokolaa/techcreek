<?php

namespace App\Domains\Custom\Http\Controllers;

use App\Domains\Custom\Models\Payment;
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

    public function show(Payment $payment)
    {
        $payment->load('product');
        return view('frontend.payments.show', compact('payment'));
    }

    public function viewAdmin(Payment $payment)
    {
        $payment->load('product');
        return view('backend.payments.show', compact('payment'));
    }
}
