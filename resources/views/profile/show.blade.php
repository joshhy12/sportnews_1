@extends('layouts.home')

@section('content')
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
        </h4>
    </x-slot>

    <div class="container" >
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mb-4">
                <strong>Name:</strong> {{ $user->name }}
            </div>

            <div class="mb-4">
                <strong>Email:</strong> {{ $user->email }}
            </div>

            <div class="mb-4">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">{{ __('Edit Account') }}</a>
            </div>
        </div>
    </div>
@endsection
