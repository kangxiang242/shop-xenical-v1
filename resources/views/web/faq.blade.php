@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/faq.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent
    <script>
        $('.question-show').click(function(){
            var is_show = $(this).attr('data-show');
            var height = $(this).find('.q-desc').height()+10+$(this).find('.q-title').height()
            if(!is_show){
                $(this).css('height',height);
                $(this).attr('data-show',1);
                $(this).find('.q-icon').html('&#xeca2;');
            }else{
                $(this).css('height',$(this).find('.q-title').height());
                $(this).removeAttr('data-show');
                $(this).find('.q-icon').html('&#xe775;');
            }

        });
    </script>


@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li class="active">常見Q&A</li>
    </ul>
@stop

@section('content')
    <section class="fqa">
        <div class="wrapper" style="">
            <div class="modal">
                <h1 class="title">常見Q&A</h1>
            </div>
            <div class="fqa-body">
                <div class="question">
                    @foreach($faq as $item)
                    <div class="item question-show">
                        <p class="q-title">Q：{{ $item->questions }}</p>
                        <p class="q-desc">{{ $item->answers }}</p>
                        <i class="q-icon iconfont">&#xe775;</i>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
