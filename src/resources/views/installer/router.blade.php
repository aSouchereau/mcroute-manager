@extends('installer.view')
@section('installer-content')
    <div>
        <h2 class="fs-2 mb-5">Router Configuration</h2>
        @if(empty($errors))
            <div class="content card p-3 w-100">
                <p class="text-success">Router Connection Successful</p>
            </div>
            <div class="installer-buttons">
                <a href="{{ route('install.migrate') }}" class="btn btn-success">
                    Next
                </a>
            </div>
        @else
            <div class="content card p-3 w-100">
                <p class="text-danger">Router Connection Failed. Please check your configuration</p>
            </div>
            <div class="installer-buttons">
                <a href="{{ route('install.router') }}" class="btn btn-success">
                    Retry
                </a>
            </div>
       @endif
    </div>

@endsection
