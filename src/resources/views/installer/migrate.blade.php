@extends('installer.view')
@section('installer-content')
    <h2>Database Migrations</h2>
    @if(empty($errors))
        <div class="installer-body">
            <strong>Migrations Successful</strong>
        </div>
        <div class="installer-buttons">
            <a href="{{ route('install.register') }}" class="btn btn-success">
                Next
            </a>
        </div>
    @else
        <div class="installer-body">
            <strong class="text-danger">Migrations Failed. Check your database configuration.</strong>
        </div>
        <div class="installer-buttons">
            <a href="{{ route('install.migrate') }}" class="btn btn-success">
                Retry
            </a>
        </div>
    @endif
@endsection
