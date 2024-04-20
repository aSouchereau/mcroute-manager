@extends('master')
@section('content')
{{ \Illuminate\Support\Facades\DB::connection()->getDatabaseName() }}
@endsection
