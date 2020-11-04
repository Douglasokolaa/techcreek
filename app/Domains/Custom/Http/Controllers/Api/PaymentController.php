<?php

namespace App\Domains\Custom\Http\Controllers\Api;

use App;
use App\Domains\Custom\Models\Payment;
use App\Domains\Custom\Models\Product;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'name'          => 'required|string|min:3',
        'email'         => 'required|email',
        'gender'        => 'required|in_array:male,female',
        'plan'          => 'required|in_array:open_cafe,coworking',
        'type'          => 'required|in_array:daily,monthly,yearly',
        'address'       => 'required',
        'phone_number'  => 'required|string',
        'duration'      => 'required|integer',
        'start_date'    => 'required|date',
        'amount'        => 'required|numeric',
    ]);

    if ($request->post('duration') == 'yearly') {
        $endDate = now()->addYear($request->post('duration'));
    } elseif ($request->post('duration') == 'monthly') {
        $endDate = now()->addMonth($request->post('duration'));
    } else {
        $endDate = now()->addDays($request->post('duration'));
    }

    DB::beginTransaction();
    $payment = Payment::create([
        'name'          => $request->post('name'),
        'email'         => $request->post('email'),
        'gender'        => $request->post('gender'),
        'plan'          => $request->post('plan'),
        'type'          => $request->post('type'),
        'address'       => $request->post('address'),
        'phone_number'  => $request->post('phone_number'),
        'duration'      => $request->post('duration'),
        'start_date'    => $request->post('start_date'),
        'end_date'      => $endDate,
        'amount'        => $request->post('amount'),
        'is_paid'       => false,
        'reference'     => Str::upper('RSICT-' . Str::random(6))
    ]);

    $pay = new Paystack;
    try {
        $paymentData = $pay->getAuthorizationResponse([
            "amount" => floatval($payment->amount) * 100,
            "reference" => $payment->reference,
            "email" => $payment->email,
            "first_name" => $payment->name,
            // "last_name" => $payment->last_name,
            "callback_url" => route('paystack.return'),
            "currency" => "NGN",
        ]);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status'  => 'dail',
            'message' => 'something Went Wrong',
            'data'   => App::environment('local') ? $e->getMessage() : '',
        ], '400');
    }

    $paymentUrl = $pay->url;

    return response()->json([
        'status'  => 'ok',
        'message' => 'payent Details',
        'url'   => $paymentUrl,
    ], '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::where('reference', $id)->get();
        if (!$payment) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Invalid Payment reference',
                'data'   => [],
            ], '403');
        }

        return response()->json([
            'status'  => 'ok',
            'message' => 'payent Details',
            'data'   => $payment->toArray(),
        ], '200');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

