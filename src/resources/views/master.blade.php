<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MC Route Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
{{--        @section('scripts')--}}
{{--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">--}}
{{--        <link rel="stylesheet" href="{{asset('css/reset.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('css/utils.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('css/header.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('css/main.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('css/tables.css')}}">--}}
{{--        @show--}}

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app">
            <header id="main">
                <nav id="main-nav" class="container">
                    <a id="main-nav-logo" href="{{route('index')}}">
                        MC Route Manager
                    </a>
                    <div id="main-nav-list">
                        <a href="{{route('index')}}" class="main-nav-item">Home</a>
                        <a href="{{route('index')}}" class="main-nav-item">Logs</a>
                        <a href="{{route('index')}}" class="main-nav-item">Settings</a>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="main-nav-item">Logout</button>
                        </form>
                    </div>
                </nav>
            </header>

            <main>
                <section id="content" class="container">
                    @yield('content')
                </section>
            </main>
        </div>

        <footer>
            <div class="footer-content container">
                <div class="footer-info-wrapper">
                    <a id="main-nav-logo" href="{{route('index')}}">
                        MC Route Manager
                    </a>
                    <span>v{{file_get_contents(public_path() . '/VERSION')}}</span>
                </div>
                <div class="footer-links-wrapper">
                    <a href="https://github.com/aSouchereau/mcroute-manager" class="link-primary">View Project on GitHub</a>
                </div>
            </div>
        </footer>
{{--        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>--}}
{{--        <script src="{{asset('js/icons.js')}}"></script>--}}
{{--        <script src="{{asset('js/tooltips.js')}}"></script>--}}
{{--        <script src="{{asset('js/fieldEditor.js')}}"></script>--}}
    </body>
</html>
