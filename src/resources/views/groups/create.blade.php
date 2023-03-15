@extends('master')
@section('content')
    <h1>New Gallery</h1>
    <form method="POST" action="{{ action([\App\Http\Controllers\GroupController::class, 'store']) }}">
        {{  csrf_field() }}
        <label for="name">Group Name:</label> <input name="name" type="text"><br>
        <label for="description">Group Description:</label> <input name="description" type="text"><br>
        <label for="image_url">Group Background Image:</label><input name="image_url" type="text"><br>
        <input type="submit" value="Submit">
        <br>
    </form>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif
@endsection
