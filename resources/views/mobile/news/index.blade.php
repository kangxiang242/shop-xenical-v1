@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/news.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/pagination.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent

@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>

        <li class="active">瘦身部落格</li>
    </ul>
@stop

@section('content')


    <section class="container">

        <div class="section-card">
            <div class="card-news">

                <div class="news-main">
                    @foreach($news as $item)
                        <div class="news clearfix">
                            <div class="image-wrapper"><a href="{{ url('news/'.$item->id) }}" title="{{ $item->title }}"><img class="news-img" src="{{ asset_upload($item->img) }}" alt="{{ $item->img_alt?:$item->title }}"></a></div>
                            <div class="desc">
                                <div class="news-text">
                                    <p class="news-title"><a href="{{ url('news/'.$item->id) }}" title="{{ $item->title }}">{{ $item->title }}</a></p>
                                    <p class="news-tips">{{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),140) }}</p>
                                </div>
                            </div>
                            <div class="go-desc"><a href="{{ url('news/'.$item->id) }}">查看全文 >></a></div>
                        </div>
                    @endforeach
                </div>

                <div class="page">
                    {!! $news->links() !!}
                </div>
            </div>
        </div>

    </section>

@endsection
