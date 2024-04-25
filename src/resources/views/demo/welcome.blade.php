@extends('demo.view')
@section('demo-setup-content')
    <div class="logo">
        <img src="/img/logomark.png" alt="mcroutemanager icon logo">
    </div>
    <div class="content">
        <p>Welcome to</p>
        <p class="fw-bold text-black fs-4 mb-2">MC Route Manager</p>
        @if($isInstalled)
            <p class="mb-5">Demo mode is active. The application has already been installed and admin account created.
                Feel free to add and remove any items you like, the app resets every hour.</p>
            <div class="installer-buttons">
                <a href="{{ route('demo.login') }}" class="btn btn-success">
                    Login
                </a>
            </div>
        @else
            <p class="mb-5">Demo mode is enabled, but has not been set up yet. Click continue to begin.</p>
            <div class="installer-buttons">
                <a href="{{ route('demo.setup') }}" class="btn btn-success">
                    Continue
                </a>
            </div>
        @endif

    </div>
@endsection
