@extends('master')
@section('content')
    <div class="installer-wrapper w-50 mx-auto">
        <div class="installer-header">
            <h2 class="fw-bold fs-2">Installer</h2>
        </div>
        <div class="installer-body">
            @yield('installer-content')
        </div>
    </div>
@endsection
