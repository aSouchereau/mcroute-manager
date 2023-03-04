<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MC Route Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/reset.css')}}">
        <link rel="stylesheet" href="{{asset('css/utils.css')}}">
        <link rel="stylesheet" href="{{asset('css/header.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
    </head>
    <body style="margin: 0; background-color: var(--bg-light-grey);">
        <header id="main">
            <nav id="main-nav" class="container">
                <a id="main-nav-logo" href="{{route('index')}}">
                    MC Route Manager
                </a>
                <div id="main-nav-list">
                    <a href="{{route('index')}}" class="main-nav-item">Home</a>
                    <a href="{{route('index')}}" class="main-nav-item">Logs</a>
                    <a href="{{route('index')}}" class="main-nav-item">Settings</a>
                    <a href="{{route('index')}}" class="main-nav-item">Logout</a>
                </div>
            </nav>
        </header>

        <main>
            <section id="content" class="container">
                @yield('content')
            </section>
        </main>
        <footer>
        </footer>
    </body>
</html>
