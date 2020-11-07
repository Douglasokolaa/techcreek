@extends('frontend.layouts.app')

@section('title', __('Products'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Products')
                    </x-slot>

                    <x-slot name="body">
                        <livewire:frontend.product-table />
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
