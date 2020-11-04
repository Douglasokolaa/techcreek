@extends('frontend.layouts.app')

@section('title', __('Dashboard- Payments'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Payments')
        </x-slot>

        <x-slot name="body">
            <div class="container py-4">
                <livewire:frontend.payment-table />
            </div>
        </x-slot>
    </x-backend.card>
@endsection
