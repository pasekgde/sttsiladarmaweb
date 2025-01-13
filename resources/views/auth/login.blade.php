@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10">
            <div class="card shadow-lg rounded-4" style="background-color: rgba(255, 255, 255, 0.8); border: 0;">
                <div class="row g-0">
                    <!-- Left Section: Text and Logo -->
                    <div class="col-md-5 d-flex flex-column align-items-center justify-content-center text-center p-4">
                        <!-- Title -->
                        @if($data && $data->nama_sistem)
                            <h3 class="text-primary fw-bold mb-2" style="font-size: 2rem;">{{$data->nama_sistem}}</h3>
                        @else
                            <h3 class="text-primary fw-bold mb-2" style="font-size: 2rem;">SIDARMA</h3>
                        @endif

                        @if($data && $data->subjudul)
                            <p class="text-muted mb-3" style="font-size: 0.9rem; font-weight: 500;">{{$data->subjudul}}</p>
                        @else
                            <p class="text-muted mb-3" style="font-size: 0.9rem; font-weight: 500;">Sistem Informasi STT Sila Darma</p>
                        @endif

                        <!-- Logo -->
                        <div class="mb-4">
                            @if($data && $data->logo)
                                <img src="{{ asset('storage/' . $data->logo) }}" width="150" alt="Logo STT Sila Dharma">
                            @else
                            <img src="https://i.ibb.co.com/bNVPrX5/logo.png" width="150" alt="Logo STT Sila Dharma">
                            @endif
                        </div>

                        <!-- Motto -->
                        @if($data && $data->deskripsi1)
                            <p class="text-muted mb-4" style="font-size: 0.9rem; font-weight: 500;">
                                {{$data->deskripsi1}}
                            </p>
                        @else
                            <p class="text-muted mb-4" style="font-size: 0.9rem; font-weight: 500;">
                                "Sagilik Saguluk, Salunglung Sabayantaka, Paras Paros Sarpanaya, Saling Asah Asih Asuh"
                            </p>
                        @endif

                        <!-- Footer Text -->
                        @if($data && $data->deskripsi2)
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                &copy; {{$data->deskripsi2}}
                            </p>
                        @else
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                &copy; 2024 Cempaga-Bangli
                            </p>
                        @endif
                    </div>

                    <!-- Right Section: Login Form -->
                    <div class="col-md-7 p-5">
                        <h4 class="text-center mb-2" style="font-size: 1.5rem; font-weight: 600;">{{ __('Selamat Datang') }}</h4>
                        <p class="text-center mb-3" style="font-size: 1rem; color: #6c757d;">{{ __('Masuk untuk mengakses ke aplikasi.') }}</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label" style="font-size: 0.9rem; font-weight: 500;">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label" style="font-size: 0.9rem; font-weight: 500;">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3" style="font-size: 0.9rem;">{{ __('Login') }}</button>
                        </form>

                        <!-- Separator -->
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <div class="separator-line" style="border-top: 1px solid #ddd; width: 80%;"></div>
                        </div>

                        <!-- Cek Denda Button -->
                        <div class="text-center">
                            <a href="{{ route('denda.check') }}" class="btn btn-success w-100" style="font-size: 0.9rem;">{{ __('Cek Denda') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
