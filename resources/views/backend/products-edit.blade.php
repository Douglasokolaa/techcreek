@extends('backend.layouts.app')

@section('title', __('Products'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Product') - {{ $product->slug }}
        </x-slot>

        <x-slot name="headerActions">
            <a href="{{  url()->previous() }}">Back</a>
        </x-slot>

        <x-slot name="body">
            <livewire:product product='{{ $product->id }}'>
        </x-slot>
    </x-backend.card>
@endsection
