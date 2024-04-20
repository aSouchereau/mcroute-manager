@extends('demo.view')
@section('demo-setup-content')
{{ \Illuminate\Support\Facades\DB::connection()->getDatabaseName() }}
@endsection
