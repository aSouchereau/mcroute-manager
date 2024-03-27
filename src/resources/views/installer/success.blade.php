@extends('installer.view')
@section('installer-content')
    <h2>Finalize Installation</h2>
    <div class="installer-body">
        <strong>Installation Successful</strong>
    </div>
    <div class="installer-buttons">
        <a href="{{ route('routes.index') }}" class="btn btn-success">
            Complete
        </a>
    </div>
@endsection
