@extends('master')
@section('content')
    <div class="w-25 mx-auto">
        <h1 class="mb-4">Login</h1>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required class="form-control" />
            </div>
            @error('username')
            <span>{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password" class="form-control" required />
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" id="remember" name="remember" class="form-check-input" />
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-success">Login</button>
        </form>
    </div>
@endsection
