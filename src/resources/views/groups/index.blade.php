@extends('master')
{{--@section('scripts')--}}
{{--    @parent--}}
{{--    <link rel="stylesheet" href="{{asset('css/home.css')}}">--}}
{{--@endsection--}}
@section('content')
    <x-home-nav activeElm="2"></x-home-nav>
    <div>
        <h1>Groups</h1>
        <p>Group routes for easier management</p>
    </div>
        <table class="home-resource-table" id="groups">
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
                    <x-group-row-form :groupData="$group"></x-group-row-form>
                @endforeach
                <x-group-row-form :groupData="null"></x-group-row-form>
            </tbody>
        </table>
@endsection
