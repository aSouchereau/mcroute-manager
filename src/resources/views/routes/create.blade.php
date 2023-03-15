@extends('master')
@section('content')
    <h1>New Route</h1>
    <form method="POST" action="{{ action([\App\Http\Controllers\RouteController::class, 'store']) }}">
        {{  csrf_field() }}
        <label for="nickname">Route Nickname:</label> <input name="nickname" type="text"><br>
        <label for="domain_name">Domain Name:</label> <input name="domain_name" type="text"><br>
        <label for="host">Host Address:</label><input name="host" type="text"><br>
        <label for="group_id">Group</label>
        <select name="group_id">
            @foreach($groups as $group)
                <option value="{{$group->id}}">{{ $group->name }}</option>
            @endforeach
        </select><br>
        <input type="hidden" name="enabled" value="1">
        <input type="submit" value="Submit">
        <br>
    </form>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif
@endsection
