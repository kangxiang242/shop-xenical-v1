@extends('web.layout')
@if($news->seo_title)
    @section('title', $news->seo_title)
@else
    @section('title', $news->title)
@endif

@if($news->seo_keyword)
    @section('keywords', $news->seo_keyword)
@endif

@if($news->seo_description)
    @section('description', $news->seo_description)
@endif
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/news-desc.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent
    <script>
        document.domain = "{{ getMainDomain() }}";
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }}
        };
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
    </script>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li><a href="{{ url('news') }}">瘦身部落格</a></li>
        <li class="active">{{ $news->title }}</li>
    </ul>
@stop

@section('content')
    <div class="container clearfix">



            <div class="news" style="margin-top: 90px;    padding-bottom: 50px;">
                <div class="news-main clearfix">
                    <h1 class="title">{{ $news->title }}</h1>
                    <div class="division">
                        {{--<span>總字數{{ $content_len = mb_strlen(strip_tags($new->content)) }}字  閱讀時間約{{ \App\Services\ArticleService::readingMinuteCount($content_len) }}</span>
                        --}}
                        <span class="time" style="float: unset">{{ $news->release_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="new-content">
                        @if($news->html_file)
                            <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="{{ asset_upload(str_replace('.zip','',$news->html_file).'/index.html') }}"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
                        @else
                            {!! $news->content !!}
                        @endif

                    </div>
                    <div class="relevant clearfix">

                        <div class="prev">
                            <p class="pte">上一篇</p>
                            @if($prev)
                                <div class="relevant-news clearfix">
                                   {{-- <a class="img-hover" href="{{ url('news/'.$prev->id) }}"><img src="{{ asset('uploads/'.$prev->img) }}" alt="{{ $prev->title }}"></a>--}}
                                    <p class="title-hover" style="    width: 300px;margin: 0"><a href="{{ url('news/'.$prev->id) }}">{{ $prev->title }}</a></p>
                                </div>
                            @endif
                        </div>
                        <div class="next">
                            <p class="pte" style="text-align: right;">下一篇</p>
                            @if($next)
                                <div class="relevant-news clearfix">
                                {{--    <a class="img-hover"  href="{{ url('news/'.$next->id) }}"><img src="{{ asset('uploads/'.$next->img) }}" alt="{{ $next->title }}"></a>--}}
                                    <p class="title-hover" style="text-align: right;    width: 300px;margin: 0"><a href="{{ url('news/'.$next->id) }}">{{ $next->title }}</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>



            </div>

    </div>

@endsection
