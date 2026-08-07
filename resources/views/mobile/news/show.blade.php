@extends('mobile.layout')
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
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/news-desc.css') }}?ver={{ config('app.asset_version') }}"/>


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
        <li class="active">{{ \Illuminate\Support\Str::limit($news->title,18) }}</li>
    </ul>
@stop

@section('content')


    <div class="news-show-wrap">
        <div class="middle">
{{--            <div class="line"></div>
            <div class="time">
                <p class="p1">發佈日期</p>
                <p class="p2">{{ $news->release_at->format('d') }}.{{ $news->release_at->format('m') }}.{{ $news->release_at->format('Y') }}</p>
            </div>--}}
            <div class="fluid">
                <div style="padding: 0 1.5rem">
                    <div class="news-title">{{ $news->title }}</div>
                    <p class="date">{{ $news->created_at->format('Y-m-d') }}</p>
                    <div class="line"></div>
                </div>
                <div class="news-content">
                    @if($news->html_file)
                        <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="{{ asset_upload(str_replace('.zip','',$news->html_file).'/index.html') }}"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
                    @else
                        {!! $news->content !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="article-footer">


            <nav class="relatednav">
                @if($prev)
                <a class="relatednav-prev" href="{{ url('news/'.$prev->id) }}">
                    <span class="relatednav-arrow"></span>
                    <span class="relatednav-title  h4 h4-mb fw-bolder">{{ $prev->title }}</span>
                </a>
                @endif

     {{--           <a class="relatednav-back  fw-bold" href="{{ url('news') }}">
                    <i class="ico-dots"><b></b></i>返回
                </a>--}}
                @if($next)
                <a class="relatednav-next" href="{{ url('news/'.$next->id) }}">
                    <span class="relatednav-arrow"></span>
                    <span class="relatednav-title  h4 h4-mb fw-bolder">{{ $next->title }}</span>
                </a>
                @endif
            </nav>
        </div>
    </div>

@endsection
