@extends('demo.view')
@section('demo-setup-content')
    <div class="mx-auto">
        <h1 class="mb-4">Login</h1>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            @if($errors->any())
                <div class="mb-3">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" value="{{ $demoEmail }}" class="form-control disabled" required readonly/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" value="{{ $demoPassword }}" class="form-control disabled" required readonly/>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" id="remember" name="remember" class="form-check-input" />
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-success">Login</button>
        </form>
    </div>
@endsection
