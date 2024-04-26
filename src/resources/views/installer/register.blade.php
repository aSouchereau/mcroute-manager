@extends('installer.view')
@section('installer-content')

<form method="POST" action="{{ route('install.register.post') }}" class="w-50 mx-auto mt-4">
    @csrf
    <h1 class="mb-3">Register Admin Account</h1>

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input id="username" type="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <span>{{ $error }}</span>
        @endforeach
    @endif
    <div>
        <button type="submit" class="btn btn-success w-100">Register</button>
    </div>
</form>
@endsection
