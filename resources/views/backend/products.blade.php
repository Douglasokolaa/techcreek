@extends('backend.layouts.app')

@section('title', __('Products'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Products')
        </x-slot>

        <x-slot name="body">
            <livewire:frontend.product-table />
        </x-slot>
    </x-backend.card>
@endsection
