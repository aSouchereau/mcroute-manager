@extends('master')
{{--@section('scripts')--}}
{{--    @parent--}}
{{--    <link rel="stylesheet" href="{{asset('css/home.css')}}">--}}
{{--@endsection--}}
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
            <form action="{{route('jobs.sync')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" id="sync-button">
                    Sync
                </button>
            </form>
            <form action="{{route('jobs.reset')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" id="reset-button">
                    Reset Router
                </button>
            </form>

        </div>
    </div>

    <table class="home-resource-table" id="routes">
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
                <x-route-row-form :routeData="$route"></x-route-row-form>
            @endforeach
            <x-route-row-form :routeData="null"></x-route-row-form>
        </tbody>
    </table>
@endsection

<x-route-create-modal></x-route-create-modal>
