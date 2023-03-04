@extends('master')
@section('content')


<h1>Hello <!-- TODO <username here> --></h1>
<section>
    <h2>Servers</h2>
    <div>
        <!-- TODO Display all groups here with dropdown for contained entries -->
        <!-- Filter by all/disabled/enabled -->
        <!-- Sort by edit/creation date -->
        <!-- Search by address, host, nickname, or group name -->

        @foreach($groups as $group)
            <h3>{{$group->name}}</h3>
            @foreach($group->routes as $route)
            Route Name: {{$route->nickname}}<br>
            Route Host: {{$route->host}}<br>
            <br>
            @endforeach
            <br>
        @endforeach
    </div>
</section>




@endsection
