@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/news.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/pagination.css') }}?ver={{ config('app.asset_version') }}"/>
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
    <section class="section">
        <div class="section-content wrapper">

            <h1 class="page-title">瘦身部落格</h1>
            <div class="main">
                <div class="news">
                    <div class="news-vse">
                        @foreach($news as $item)
                            <div class="item">
                                <div class="img-wrapper"><a href="{{ url('news/'.$item->id) }}"><img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->img_alt?:$item->title }}" oncontextmenu="return false;"></a></div>
                                <div class="info">
                                    <p class="new-title"><a href="{{ url('news/'.$item->id) }}">{{ $item->title }}</a></p>
                                    <p class="new-desc">
                                        {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),240) }}
                                    </p>
                                    <p class="go"><a class="go-btn" href="{{ url('news/'.$item->id) }}">閱讀全文 >></a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="page">
                        {!! $news->links() !!}
                    </div>
                </div>

                <div class="popularity">
                    <div class="popularity-row">
                        <div class="box-header">
                            <a class="title" href="javascript:;">最新資訊</a>
                        </div>
                        <div class="popularity-product popularity-title-edition">

                            <div class="list">
                                @foreach($newNews as $item)
                                    <div class="list-item">
                                        <a class="main-color-hover" href="{{ url('news/'.$item->id) }}">{{ $item->title }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
