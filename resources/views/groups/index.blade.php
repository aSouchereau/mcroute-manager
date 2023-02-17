@extends('master')
@section('content')
    <h2>All Groups</h2>
    @foreach ($groups as $group)
        Group ID: {{ $group->id }}<br>
        Group Name: {{ $group->name }}<br>
        Description: {{ $group->description }}<br>
        <a href="{{ action([\App\Http\Controllers\GroupController::class, 'edit'], $group->id) }}">[edit]</a><br>
        <br>
    @endforeach
@endsection
