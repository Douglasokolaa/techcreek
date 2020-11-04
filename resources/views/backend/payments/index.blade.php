@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Payments')
        </x-slot>

        <x-slot name="body">
            <livewire:frontend.payment-table />
        </x-slot>
    </x-backend.card>
@endsection
