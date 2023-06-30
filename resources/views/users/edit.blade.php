@extends('layouts.home')

@section('content')
<x-slot name="header">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Account') }}
        </h2>
    </div>
</x-slot>

<div class="container">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="text-right">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('users.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? auth()->user()->name }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ?? auth()->user()->email }}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" autocomplete="current-password" required>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
