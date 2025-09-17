<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title ?? config('app.name', 'Transações') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <style>
        body { background-color: #f5f7f8; }
        .sidebar {
            width: 90px;
            background-color: #000;
            min-height: 100vh;
            max-height: 90vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 10px;
        }
        .sidebar .nav-link {
            color: #fff;
            text-align: center;
            padding: 20px 0;
            display: block;
            width: 100%;
            text-decoration: none;
        }
        .sidebar .nav-link.active {
            background-color: #111;
        }
        .content {
            margin-left: 90px;
            padding: 20px;
            min-height: 100vh;
        }
        .logo img {
            width: 50px;
            margin-bottom: 20px;
        }
        header.page-header {
            background: white;
            padding: 15px 20px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="font-sans antialiased">

    @include('layouts.navigation')

    <div class="min-h-screen d-flex">
        <div class="sidebar">
            <div class="logo">
                <img src="/imagens/logo.png" alt="Logo" />
            </div>
            <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                Transações
            </a>
            <a href="{{ route('balanco.index') }}" class="nav-link {{ request()->routeIs('balanco.*') ? 'active' : '' }}">
                Balanço
            </a>
        </div>

        <div class="content flex-grow-1">
            @if(View::hasSection('header'))
                <header class="page-header">
                    <h1 class="m-0 h4">@yield('header')</h1>
                </header>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
