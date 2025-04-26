@extends('layout.body-login')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
<link href="{{ asset('css/wedding-login.css') }}" rel="stylesheet">

<div class="split-screen-container">
    <!-- Photo Panel (Left side) -->
    <div class="photo-panel">
        <img src="{{ asset('storage/images/capa.jpg') }}" alt="Happy Couple" class="couple-image">
    </div>
    
    <!-- Autumn Background (Right side) -->
    <div class="autumn-panel">
        <!-- Autumn-themed background is handled by CSS -->
    </div>
    
    <!-- Centered Login Form -->
    <div class="wedding-login-container">
        <h1 class="wedding-login-title">Wigo & Isabella</h1>
        <p class="wedding-login-subtitle">Bem vindos ao nosso casamento</p>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="wedding-form-group">
                <x-input-label for="email" :value="__('E-mail')" class="wedding-form-label" />
                <x-text-input id="email" class="wedding-form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="wedding-error-message" />
            </div>

            <!-- Password -->
            <div class="wedding-form-group">
                <x-input-label for="password" :value="__('Senha')" class="wedding-form-label" />
                <x-text-input id="password" class="wedding-form-input" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="wedding-error-message" />
            </div>

            <!-- Remember Me -->
            <div class="wedding-form-group">
                <label for="remember_me" class="wedding-checkbox-container">
                    <input id="remember_me" type="checkbox" class="wedding-checkbox" name="remember">
                    <span class="wedding-checkbox-label">{{ __('Lembrar') }}</span>
                </label>
            </div>

            <div class="wedding-login-footer">
                <button type="submit" class="wedding-login-button">
                    {{ __('Acessar') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection