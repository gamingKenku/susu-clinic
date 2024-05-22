<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Медицинский центр ЮУрГУ')</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/7b5b2affc9.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @php
        use App\Models\Clinic;
    @endphp

    <div id="app">
        <div class="shadow-sm">
            <nav class="navbar navbar-expand-md navbar-light bg-white">
                <div class="container">
                    <a class="navbar-brand me-3" href="{{ url('/') }}">
                        <img style="width: 100px; height: 100px;" class="w-100" src="{{ asset('storage/logo.svg') }}"
                            alt="">
                    </a>
                    <a class="navbar-brand me-auto" href="{{ url('/') }}">
                        Медицинский центр ЮУрГУ
                    </a>

                    {{-- <div class="ms-auto d-none d-md-block">
                        @foreach (Clinic::all() as $clinic)
                            <a href="{{ route('contactsIndex') . "/#clinic$clinic->id" }}">{{ $clinic->name }}</a>
                            <br>
                        @endforeach
                    </div> --}}
                </div>
            </nav>
            <nav class="navbar navbar-expand-md navbar-light bg-white">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <div class="navbar-nav me-auto">
                            <a class="nav-link" href="{{ route('about') }}">О центре</a>
                            <a class="nav-link" href="{{ route('managementIndex') }}">Руководство</a>
                            <a class="nav-link" href="{{ route('staffIndex') }}">Специалисты</a>
                            <a class="nav-link" href="{{ route('servicesIndex') }}">Услуги</a>
                            <a class="nav-link" href="{{ route('contactsIndex') }}">Контакты</a>
                            <a class="nav-link" href="{{ route('feedbackIndex') }}">Отзывы</a>
                            <a class="nav-link" href="{{ route('workingHoursIndex') }}">Расписание</a>
                            <a class="nav-link" href="{{ route('discountsIndex') }}">Акции</a>
                            <a class="nav-link" href="{{ route('vacanciesIndex') }}">Вакансии</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="footer mt-auto py-3">
            <div class="container">
                <div class="d-flex">
                    <div class="me-auto">
                        <span class="text-muted">Медицинский центр ЮУрГУ</span>
                    </div>
                    <div class="ms-auto">
                        
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
