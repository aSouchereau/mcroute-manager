@extends('master')
@section('scripts')
    @parent
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')
    <x-home-nav activeElm="1"></x-home-nav>
    <div class="content-header">
        <div>
            <h1>Routes</h1>
            <p>Map a source domain to a destination address</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary" id="create-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                New Route
            </button>
        </div>
    </div>

    <table class="home-resource-table">
        <thead>
            <tr>
                <th>nickname</th>
                <th>source domain</th>
                <th>destination</th>
                <th>group</th>
                <th>enabled</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($routes as $route)
            <tr>
                <td>{{$route->nickname}}</td>
                <td>{{$route->domain_name}}</td>
                <td>{{$route->host}}</td>
                <td>{{$route->group_id}}</td>
                <td>@if($route->enabled) enabled @else disabled @endif</td>
                <td><x-edit-button tooltipName="Route" ></x-edit-button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

<x-route-create-modal></x-route-create-modal>
