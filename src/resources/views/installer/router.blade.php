@extends('installer.view')
@section('installer-content')
    <h2>Router Configuration</h2>
@if(empty($errors))
    <div class="installer-body">
        <strong>Router Connection Successful</strong>
    </div>
    <div class="installer-buttons">
        <a href="{{ route('install.migrate') }}" class="btn btn-success">
            Next
        </a>
    </div>
@else
    <div class="installer-body">
        <strong class="text-danger">Router Connection Failed</strong>
    </div>
    <div class="installer-buttons">
        <a href="{{ route('install.router') }}" class="btn btn-success">
            Retry
        </a>
    </div>
@endif

@endsection
