@extends('master')
@section('content')
    <div class="w-25 mx-auto">
        <h1 class="mb-4">Login</h1>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" required class="form-control" />
            </div>
            @error('email')
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
