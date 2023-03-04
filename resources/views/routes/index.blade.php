@extends('master')
@section('content')
    <div>
        <h1>Routes</h1>
        <p>Map a source domain to a destination address</p>
    </div>
    <h2>All Routes</h2>
    @foreach ($routes as $route)
        Route ID: {{ $route->id }}<br>
        Route Nickname: {{ $route->nickname }}<br>
        Domain Name: {{ $route->domain_name }}<br>
        Host Address: {{ $route->host }}<br>
        Group ID: {{ $route->group_id }}<br>
        @if($route->enabled)
            enabled
        @else
            disabled
        @endif
    @endforeach
@endsection
