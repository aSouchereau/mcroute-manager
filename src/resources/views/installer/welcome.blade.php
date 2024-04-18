@extends('installer.view')
@section('installer-content')
    <div class="logo">
        <img src="/img/logomark.png" alt="mcroutemanager icon logo">
    </div>
    <div class="content">
        <p>Welcome to</p>
        <p class="fw-bold text-black fs-4 mb-5">MC Route Manager</p>

        <div class="installer-buttons">
            <a href="{{ route('install.router') }}" class="btn btn-success">
                Begin Setup
            </a>
        </div>
    </div>
@endsection
