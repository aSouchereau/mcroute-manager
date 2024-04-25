@extends('demo.view')
@section('demo-setup-content')
    <div>
        <h2 class="fs-2 mb-5">Demo Mode Setup</h2>
            <div class="content card p-3 w-100">
                <p class="text-success">Setup Successful</p>
            </div>
            <div class="installer-buttons">
                <a href="{{ route('demo.login') }}" class="btn btn-success">
                    Next
                </a>
            </div>
    </div>
@endsection
