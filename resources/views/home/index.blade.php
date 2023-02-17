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
            {{$group->name}} <br>
            Routes:
            @foreach($group->routes() as $route)
            {{$route->nickname}}
            {{$route->host}}
            @endforeach
        @endforeach
    </div>
</section>




@endsection
