@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/page.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent


@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li class="active">{{ $title }}</li>
    </ul>
@stop

@section('content')

    <section class="page-container">
        <div class="page-main">
            <h1 class="title">{{ $title }}</h1>
            <div class="page-body">
                {!! $content !!}
            </div>
        </div>
    </section>

@endsection
