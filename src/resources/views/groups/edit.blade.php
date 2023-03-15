@extends('master')
@section('content')
    <h1>Edit Group</h1>
    <form method="POST" action="{{ route('groups.update', $group->id) }}">
        @method('PATCH')
        @csrf
        <label for="name">Group Name:</label>
        <input name="name" type="text" value="{{$group->name}}"><br>
        <label for="description">Group Description:</label>
        <input name="description" type="text" value="{{$group->description}}"><br>
        <label for="image">Group Background Image:</label>
        <input name="image" type="text" value="{{$group->image_url}}">
        <input type="submit" value="Submit"><br>
    </form>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    @endif
@endsection
