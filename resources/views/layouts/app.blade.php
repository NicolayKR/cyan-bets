<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Scripts -->
    @if !(Route::is('login') or Route::is('register'))
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    @endif
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header-component ></header-component>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
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
                                    Ошибочные объекты
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
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                    @yield('content')   
                </main>
            </div>
        </div>
    </div>
</body>
</html>
