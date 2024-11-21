@extends('themes::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('themes.name') !!}</p>
@endsection
