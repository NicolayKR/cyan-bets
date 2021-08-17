<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}" defer></script>
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body tab>
    <div id="app">
        <header-component ></header-component>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a {!! (Route::is('/') ? 'class="nav-link active"' : 'class="nav-link"') !!} aria-current="page" href="/">
                                    <i class="fas fa-home feather feather-home"></i>
                                    Главная
                                </a>
                            </li>
                            <li class="nav-item">
                                <a {!! (Route::is('index') ? 'class="nav-link active"' : 'class="nav-link"') !!} aria-current="page" href="/index">
                                    <i class="fas fa-gavel feather feather-home"></i>
                                    Ставки
                                </a>
                            </li>
                            <li class="nav-item">
                                @if (Route::is('accounts.index') or Route::is('accounts.create') or Route::is('accounts.edit')) 
                                <a class="nav-link active" href="/accounts">
                                <i class="fas fa-atlas feather feather-home"></i>
                                    Фиды
                                </a>
                                @else
                                <a class="nav-link" href="/accounts">
                                <i class="fas fa-atlas feather feather-home"></i>
                                    Фиды
                                </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-clipboard-list feather feather-home"></i>
                                    Стратегия
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-chart-bar feather feather-home"></i>
                                    Статистика
                                </a>
                            </li>
                            <li class="nav-item">
                                <a {!! (Route::is('errors') ? 'class="nav-link active"' : 'class="nav-link"') !!} href="/errors">
                                <i class="fas fa-exclamation-triangle feather feather-home"></i>
                                    Ошибки
                                </a>
                               
                            </li>
                            <li class="nav-item">
                                <a {!! (Route::is('question') ? 'class="nav-link active"' : 'class="nav-link"') !!} href="/question">
                                <i class="far fa-question-circle feather feather-home"></i>
                                    Вопросы
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>  
                <main class="py-4 index-part">
                    @yield('content')   
                </main>
            </div>
        </div>
    </div>
</body>
</html>
