@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/product.css') }}?ver={{ config('app.asset_version') }}">
@stop


@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>

        <li class="active">減肥藥購買</li>
    </ul>
@stop

@section('embed-banner')
{{--    <div class="embed-banner">
        <h1 class="embed-title">{!! app('cache.config')->get('page_product_title') !!}</h1>
        <div class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_desc')) !!}</div>
    </div>--}}
@stop

@section('content')
    <section class="product-section">

        <div class="wrap">
            <h1 class="title">減肥藥購買</h1>
            <div class="main">
                @foreach($products as $key=>$goods)

                <div class="goods">

                    <div class="info" >
                        <div class="goods-img"><a href="{{ url('product/'.$goods->id) }}"><img src="{{ asset('uploads/'.$goods->img) }}" alt="{{ $goods->name }}"></a></div>
                        <div class="boa">
                            <p class="title"><a href="{{ url('product/'.$goods->id) }}">{{ $goods->name }}</a></p>
                            <div class="label">
                                <span class="label-item">{{ $goods->label }}</span>
                                @if($goods->quantity >= 3)
                                    <span class="label-item">限時優惠</span>
                                    <span class="label-item">免運費</span>
                                @endif
                                <span class="label-item">無效可退</span>
                                <span class="label-item">原廠正品</span>
                            </div>
                            <div class="pricebox">
                                <div class="price">
                                    @if($goods->quantity >= 3)
                                        <p class="market">NT$ {{ number_format(round($goods->market_price)) }}</p>
                                    @else
                                        <p class="market" style="text-decoration: none !important;">官方售價</p>
                                    @endif
                                   
                                    <p class="now">NT$ {{ number_format(round($goods->price)) }}</p>
                                </div>
                                <a class="go-btn" href="{{ url('checkout/'.$goods->id) }}" data-observer="立即購買">
                                    <p >立即訂購</p>
                                <i class="iconfont">&#xe719;</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach

            </div>

            <div class="product-description">
                <p class="description-warp">
                    {!! app('cache.config')->get('page_product_desc') !!}
                </p>
            </div>

        </div>
    </section>
@endsection
