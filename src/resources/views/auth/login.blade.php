@extends('master')
@section('content')
<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    @error('email')
        <span>{{ $message }}</span>
    @enderror
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="current-password">
    </div>
    <div>
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label>
    </div>

    <button type="submit">Login</button>
</form>
@endsection
