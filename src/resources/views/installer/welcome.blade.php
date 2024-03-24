@extends('installer.view')
@section('installer-content')
    <p>Welcome to McRouteManager</p>

    <div class="installer-buttons">
        <a href="{{ route('install.router') }}" class="btn btn-success">
            Begin Setup
        </a>
    </div>
@endsection
