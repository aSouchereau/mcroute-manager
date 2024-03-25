@extends('installer.view')
@section('installer-content')

<form method="POST" action="{{ route('install.register.post') }}">
    @csrf
    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <span>{{ $error }}</span>
        @endforeach
    @endif
    <div>
        <button type="submit">Register</button>
    </div>
</form>
@endsection
