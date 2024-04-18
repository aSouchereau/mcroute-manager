@extends('installer.view')
@section('installer-content')
<div>
    <h2 class="fs-2 mb-5">Installation Successful</h2>
    <div class="installer-buttons">
        <a href="{{ route('routes.index') }}" class="btn btn-success">
            Complete
        </a>
    </div>
</div>
@endsection
