@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name, Enter Payment Reference to search', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            <livewire:search />
        </x-slot>
    </x-backend.card>
@endsection
