<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>STT SILA DHARMA-Cempaga</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/customcekdenda.css') }}">

    <style>
        /* Styling for the Body to center the logo */
body {
    @if($data && $data->background)
        background-image: url('{{ asset('storage/' . $data->background) }}');
    @else
        background-image: url('https://i.ibb.co.com/Fbvdwh9/temple-gates-lempuyang-luhur-temple-bali-indonesia.jpg');
    @endif
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Center the logo */
.text-center img {
    display: block;
    margin: 0 auto;
}

/* Border for the Quote */
.quote-box {
    border: 2px solid #6a11cb;  /* Warna border ungu */
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.8);  /* Warna latar belakang kutipan */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

blockquote {
    margin: 0;
}

blockquote footer {
    font-size: 0.9rem;
    color: #555;
}

blockquote p {
    font-style: italic;
    font-weight: bold;
}

/* Button Customization */
.btn-primary {
    background-color: #6a11cb;
    border-color: #6a11cb;
}

.btn-primary:hover {
    background-color: #2575fc;
    border-color: #2575fc;
}

/* Customizing Form Inputs */
.form-control {
    border-radius: 30px;
    box-shadow: none;
    border: 1px solid #ddd;
}

.form-control:focus {
    border-color: #6a11cb;
    box-shadow: 0 0 10px rgba(106, 17, 203, 0.5);
}

/* Responsive Adjustments */
@media (max-width: 576px) {
    .card-body {
        padding: 2rem;
    }

    /* Ensure quote-box has margin at smaller screens */
    .quote-box {
        margin-top: 20px;
    }
}

    </style>

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @livewireStyles
</head>
<body>
@include('sweetalert::alert')
    <div id="app">
        <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    STT SILA DHARMA
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
                    <ul class="navbar-nav me-auto">

                    </ul>

         
                    <ul class="navbar-nav ms-auto">
             
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                    
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> -->

        <div class="clearfix"></div>
        @yield('content')
    @livewireScripts
    </div>
</body>
</html>
