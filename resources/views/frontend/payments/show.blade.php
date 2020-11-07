@extends('frontend.layouts.app')

@section('title', __('Payments'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Payments')
                    </x-slot>
                    <x-slot name="body">
                        @if (\Carbon\Carbon::parse($payment->end_date)->isPast())
                        <div class="bg-danger alert alert-danger">
                            <p class="font-weight-bold text-center text-white mb-0">{{ __('This Pyament is Expired') }}</p>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-default">
                                        <tr>
                                            <th colspan="2" class="text-center">Purchase Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold text-info">Status</td>
                                            <td>{{ view('backend.includes.payment.status',['status' => $payment->status]) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">Space</td>
                                            <td>{{ $payment->product->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">Amount</td>
                                            <td>NGN {{ $payment->amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">Duration</td>
                                            <td>{{ $payment->period() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">Start Date</td>
                                            <td>{{ $payment->start_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">End Date</td>
                                            <td>{{ $payment->end_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">Reference</td>
                                            <td class="font-weight-bold"> {{ $payment->reference }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-default">
                                        <tr>
                                            <th colspan="2" class="text-center">User Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold text-info">Full Name</td>
                                            <td> {{ $payment->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">Gender</td>
                                            <td> {{ $payment->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">Email</td>
                                            <td> {{ $payment->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold text-info">phone_number</td>
                                            <td> {{ $payment->phone_number }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </x-slot>
                </x-frontend.card>
            </div>
            <!--col-md-10-->
        </div>
        <!--row-->
    </div>
    <!--container-->
@endsection
