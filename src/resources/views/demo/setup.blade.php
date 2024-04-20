@extends('demo.view')
@section('demo-setup-content')
    <div>
        <h2 class="fs-2 mb-5">Demo Mode Setup</h2>
        @if(empty($errors))
            <div class="content card p-3 w-100">
                <p class="text-success">Migrations Successful</p>
            </div>
            <div class="installer-buttons">
                <a href="{{ route('install.register') }}" class="btn btn-success">
                    Next
                </a>
            </div>
        @else
            <div class="installer-body">
                <strong class="text-danger">Setup Failed.</strong>
            </div>
            <div class="installer-buttons">
                <a href="{{ route('install.migrate') }}" class="btn btn-success">
                    Retry
                </a>
            </div>
        @endif
    </div>
@endsection
