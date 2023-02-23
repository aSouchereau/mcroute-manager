@extends('master')
@section('content')
    <h1>Edit Route</h1>
    <form method="POST" action="{{ route('routes.update', $route->id) }}">
        @method('PATCH')
        @csrf
        <label for="name">Route Nickname: </label>
        <input name="name" type="text" value="{{$route->nickname}}"><br>
        <label for="description">Domain: </label>
        <input name="description" type="text" value="{{$route->domain_name}}"><br>
        <label for="image">Host: </label>
        <input name="image" type="text" value="{{$route->host}}">
        <input type="submit" value="Submit"><br>
    </form>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    @endif
@endsection
