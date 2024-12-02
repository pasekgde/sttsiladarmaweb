@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg rounded-4">
                <div class="card-body p-5">
                    <!-- Logo di Tengah -->
                    <div class="text-center mb-4">
                        <img src="https://i.ibb.co.com/bNVPrX5/logo.png" width="120" alt="Logo STT Sila Dharma">
                    </div>
                    <h4 class="text-center mb-4">{{ __('Login to Your Account') }}</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me & Login Button -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted small">{{ __('Forgot Your Password?') }}</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('Login') }}</button>
                    </form>

                    <!-- Pemisah Antara Tombol Login dan Cek Denda -->
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="separator-line" style="border-top: 1px solid #ddd; width: 80%;"></div>
                    </div>

                    <!-- Cek Denda Button -->
                    <div class="text-center mt-3">
                        <a href="{{ route('denda.check') }}" class="btn btn-outline-secondary w-100">{{ __('Cek Denda') }}</a>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted small">{{ __('Don\'t have an account?') }} <a href="{{ route('register') }}" class="text-primary">{{ __('Sign up') }}</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Section with Quote and Text -->
        <div class="col-md-6 mt-4 mt-md-0 text-center">
            <!-- Border for the quote -->
            <div class="quote-box p-4">
                <blockquote class="blockquote">
                    <p class="mb-3"><i><b>"Sagilik Saguluk, Salunglung Sabayantaka, Paras Paros Sarpanaya, Saling Asah Asih Asuh"</b></i></p>
                    <footer class="blockquote-footer">Bersatu padu, menghargai pendapat orang lain, memutuskan segala sesuatu dengan cara musyawarah dan mufakat, saling mengingatkan, menyayangi dan membantu.</footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
@endsection
