@extends('master')
@section('scripts')
    @parent
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')
    <x-home-nav activeElm="2"></x-home-nav>
    <div>
        <h1>Groups</h1>
        <p>Group routes for easier management</p>
    </div>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>description</th>
                    <th>routes</th>
                    <th>enabled</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{$group->name}}</td>
                    <td>{{$group->description}}</td>
                    <td>{{$group->routes->count()}}</td>
                    <td>enable</td>
                    <td><a href="{{ action([\App\Http\Controllers\GroupController::class, 'edit'], $group->id) }}">[edit]</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endsection
