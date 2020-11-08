<?php

namespace App\Domains\Custom\Http\Controllers\Api;

use App;
use App\Domains\Custom\Models\Payment;
use App\Domains\Custom\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Paystack;
use Hidehalo\Nanoid\Client;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all()->makeHidden(['id', 'is_active']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|string|min:3',
            'email'         => 'required|email',
            'gender'        => 'required|in:male,female',
            'plan'          => ['required', Rule::exists('products', 'slug')],
            'type'          => 'required|in:daily,monthly,yearly',
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
        $client = new Client();
        $product = Product::where('slug', $request->plan)->first();
        $payment = $product->payments()->create([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'gender'        => $request->post('gender'),
            'type'          => $request->post('type'),
            'address'       => $request->post('address'),
            'phone_number'  => $request->post('phone_number'),
            'duration'      => $request->post('duration'),
            'start_date'    => $request->post('start_date'),
            'end_date'      => $endDate,
            'amount'        => $request->post('amount'),
            'status'        => 1,
            'reference'     => 'RS' . $client->formattedId($alphabet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $size = 6),
        ]);

        try {
            $pay = Paystack::getAuthorizationResponse([
                "amount" => floatval($payment->amount) * 100,
                "reference" => $payment->reference,
                "email" => $payment->email,
                "first_name" => $payment->name,
                // "last_name" => $payment->last_name,
                // "callback_url" => route('paystack.return'),
                "currency" => "NGN",
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status'  => false,
                'message' => 'something Went Wrong',
                'data'   => App::environment('local') ? $e->getMessage() : '',
            ], '400');
        }

        return response()->json($pay, '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($reference)
    {
        $payment = Payment::where('reference', $reference)->first();
        if (!$payment) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid Payment reference',
                'data'   => [],
            ], '403');
        }

        return response()->json([
            'status'  => false,
            'message' => 'Invalid Payment reference',
            'data'   => PaymentResource::make($payment)
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
