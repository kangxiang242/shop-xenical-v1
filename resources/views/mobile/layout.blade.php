<!DOCTYPE html>
<html lang="zh-TW" style="font-size: 62.5%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    @if(app('cache.config')->get('google_verify_type') == 1)
        {!! app('cache.config')->get('google_verify_code') !!}
    @endif
    @if(isset($layout['seo']))
        <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @else
        @hasSection('title')
            <title>@yield('title')</title>
        @else
            <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
        @endif
    @endif

    @hasSection('keywords')
        <meta name="keywords" content="@yield('keywords')"/>
    @else
        <meta name="keywords" content="{{ isset($layout['seo'])?$layout['seo']->key_word:"" }}"/>
    @endif

    @hasSection('description')
        <meta name="description" content="@yield('description')"/>
    @else
        <meta name="description" content="{{ isset($layout['seo'])?$layout['seo']->description:"" }}"/>
    @endif


    <link rel="canonical" href="{{ config('app.url') }}/{{ trim(request()->path(),'/') }}">

    <link rel="shortcut icon" href="{{ asset_upload(app('cache.config')->get('favicon'),'/favicon.ico') }}">
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}?ver={{ config('app.asset_version') }}"/>
        @if(!is_googlebot())
        <link rel="stylesheet" href="{{ asset('static/font_3122894_o33hqrxtwf/iconfont.css') }}?ver={{ config('app.asset_version') }}">
        @endif
        <link rel="stylesheet" href="{{ asset('static/mobile/less/global.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" href="{{ asset('static/swiper4/swiper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('static/less/customer-service.css') }}?ver={{ config('app.asset_version') }}">
        <style>

            .countdown .bloc-time {
                float: left;
                text-align: center;
                display: flex;
                align-self: center;
            }
            .countdown .bloc-time:after {
                content: "时";
                padding: 0 0.4rem;
                font-weight: 700;
                font-size: 1.4rem;

                display: flex;
                align-self: center;
                color: #fff;
            }


            .countdown .bloc-time.hours:after {
                content: "时";

            }
            .countdown .bloc-time.min:after {
                content: "分";

            }
            .countdown .bloc-time.sec:after {
                content: "秒";

            }

            .countdown .bloc-time:last-child {
                margin-right: 0;
            }

            .countdown .count-title {
                display: block;
                margin-bottom: 15px;
                font: normal 1.24em "Lato";
                color: #1a1a1a;
                text-transform: uppercase;
            }
            .countdown .figure {
                position: relative;
                text-align: center;
                float: left;
                height: 3rem;
                width: 2.4rem;
                margin-right: 0.4rem;
                background-color: #fff;
                border-radius: 6px;
                overflow: hidden;
/*                -moz-box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2), inset 2px 4px 0 0 rgba(255, 255, 255, 0.08);
                -webkit-box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2), inset 2px 4px 0 0 rgba(255, 255, 255, 0.08);
                box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2), inset 2px 4px 0 0 rgba(255, 255, 255, 0.08);*/
            }
            .countdown .figure:last-child {
                margin-right: 0;
            }
            .countdown .figure > span {
                position: absolute;
                left: 0;
                right: 0;
                margin: auto;
                /*  font: normal 5.94em/107px "Lato";*/
                font-family: "Lato";
                font-size: 2.4rem;
                font-weight: 700;
                line-height: 2.8rem;
                color: #de4848;
            }
            .countdown .figure .top:after, .countdown .figure .bottom-back:after {
                content: "";
                position: absolute;
                z-index: -1;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 100%;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }
            .countdown .figure .top {
                z-index: 3;
                background-color: #f7f7f7;
                transform-origin: 50% 100%;
                -webkit-transform-origin: 50% 100%;
                -moz-border-radius-topleft: 0.1rem;
                -webkit-border-top-left-radius: 0.1rem;
                border-top-left-radius: 0.1rem;
                -moz-border-radius-topright: 0.1rem;
                -webkit-border-top-right-radius: 0.1rem;
                border-top-right-radius: 0.1rem;
                -moz-transform: perspective(20rem);
                -ms-transform: perspective(20rem);
                -webkit-transform: perspective(20rem);
                transform: perspective(20rem);
            }
            .countdown .figure .bottom {
                z-index: 1;
            }
            .countdown .figure .bottom:before {
                content: "";
                position: absolute;
                display: block;
                top: 0;
                left: 0;
                width: 100%;
                height: 50%;
                background-color: rgba(0, 0, 0, 0.02);
            }
            .countdown .figure .bottom-back {
                z-index: 2;
                top: 0;
                height: 50%;
                overflow: hidden;
                background-color: #f7f7f7;
                -moz-border-radius-topleft: 1rem;
                -webkit-border-top-left-radius: 1rem;
                border-top-left-radius: 1rem;
                -moz-border-radius-topright: 1rem;
                -webkit-border-top-right-radius: 1rem;
                border-top-right-radius: 1rem;
            }
            .countdown .figure .bottom-back span {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                margin: auto;
            }
            .countdown .figure .top, .countdown .figure .top-back {
                height: 50%;
                overflow: hidden;
                -moz-backface-visibility: hidden;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
            }
            .countdown .figure .top-back {
                z-index: 4;
                bottom: 0;
                background-color: #fff;
                -webkit-transform-origin: 50% 0;
                transform-origin: 50% 0;
                -moz-transform: perspective(20rem) rotateX(180deg);
                -ms-transform: perspective(20rem) rotateX(180deg);
                -webkit-transform: perspective(20rem) rotateX(180deg);
                transform: perspective(20rem) rotateX(180deg);
                -moz-border-radius-bottomleft: 1rem;
                -webkit-border-bottom-left-radius: 1rem;
                border-bottom-left-radius: 1rem;
                -moz-border-radius-bottomright: 1rem;
                -webkit-border-bottom-right-radius: 1rem;
                border-bottom-right-radius: 1rem;
            }
            .countdown .figure .top-back span {
                position: absolute;
                top: -100%;
                left: 0;
                right: 0;
                margin: auto;
            }
        </style>
    @show

    <script src="{{ asset('static/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/jquery_lazyload/jquery.lazyload.min.js') }}"></script>
    <script src="{{ asset('static/swiper4/swiper.min.js') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}"></script>
    <script>
        var clientWidth = document.documentElement.clientWidth;
        ;(function (doc, win, undefined) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in win? 'orientationchange' : 'resize',
                recalc = function () {
                    clientWidth = docEl.clientWidth;
                    if(docEl.clientWidth > 768){
                        clientWidth = 768

                    }
                    docEl.style.fontSize = clientWidth / 37.5 + 'px';
                };
            if (doc.addEventListener === undefined) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false)
        })(document, window);
        if(clientWidth > 768){
            clientWidth = 768
        }
        document.documentElement.style.fontSize = clientWidth / 37.5 + 'px';
    </script>

    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '{!! session()->get('flash') !!}';
        if(flash_data){
            flash_data = JSON.parse('{!! session()->get('flash') !!}');
        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("{{ \App\Services\ConfigService::get('freight_where',0) }}");
        var free_shipping_freight = parseInt("{{ \App\Services\ConfigService::get('freight',0) }}");

    </script>


</head>
<body>

@section('header')
    <header>
        <div class="top-sec">
            <a class="logo" href="{{ url('/') }}">
                <img src="{{ asset('static/img/logo.png') }}" alt="logo">
            </a>

        </div>

    </header>
@show



@section('banner')
    @if(isset($layout['banners']) && $layout['banners'] && !$layout['banners']->isEmpty())
        <section class="banner-section">
            <div class="banner-main">
                @foreach($layout['banners'] as $key=>$item)
                    @if($item->m_img)
                        <a href="{{ $item->href?url($item->href):"javascript:;" }}"><img src="{{ asset_upload($item->m_img) }}" alt="{{ $item->alt }}"></a>
                    @endif
                @endforeach
            </div>
            @yield('embed-banner')
        </section>
    @endif
@show

@section('breadcrumb')

@show

@yield('content')





<footer>
    <div class="ft-main">
        <div class="ft-left">
            <!-- <div class="logo-box">
                <div class="row">
                    <img width="180" src="{{ asset('static/img/logo.png') }}?ver={{ config('app.asset_version') }}" alt="footer-logo">

                </div>
            </div> -->
            <div class="conceal clearfix">

                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.8rem">&#xe6fc;</i></div>
                    <p>歐洲進口</p>
                </div>
                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.4rem">&#x100d2;</i></div>
                    <p>原廠正品</p>
                </div>
                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.4rem">&#xe609;</i></div>
                    <p>現貨供應</p>
                </div>
                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.8rem">&#xe714;</i></div>
                    <p>當天發貨</p>
                </div>

                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.4rem">&#xe6d0;</i></div>
                    <p>隱密發貨</p>
                </div>
                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.4rem">&#xe6ce;</i></div>
                    <p>買家好評</p>
                </div>
                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.2rem">&#xe6f5;</i></div>
                    <p>免費退換</p>
                </div>
                <div class="co-item">
                    <div class="icon-box"><i class="iconfont" style="font-size: 2.2rem">&#xe6f8;</i></div>
                    <p>安全結帳</p>
                </div>

            </div>
        </div>
    </div>
    <div class="partner">
        <div class="icon"><img  style="width: 12.6rem" src="{{ asset('static/img/fdausa.png') }}" alt="fda-usa"></div>
        <div class="icon"><img style="width: 15.2rem" src="{{ asset('static/img/ema.png') }}" alt="ema"></div>
        <!-- <div class="icon"><img  style="width: 14.5rem" src="{{ asset('static/img/fdataiwan.png') }}" alt="台湾fda"></div> -->
        <div class="icon"><img  style="width: 10rem" src="{{ asset('static/img/CHEPLA.png') }}" alt="CHEPLA"></div>
        <!-- <div class="icon"><img  style="width: 9.2rem; padding-top: 1rem;" src="{{ asset('static/img/7-11.png') }}" alt="7-11"></div>
        <div class="icon"><img  style="width: 10.2rem; padding-top: 1rem;" src="{{ asset('static/img/heimao.png') }}" alt="黑猫宅急便"></div> -->
    </div>

    
    <div class="f-nav">
        <a href="{{ url('message') }}">首頁</a>
        <a href="{{ url('message') }}">減肥藥購買</a>
        <a href="{{ url('message') }}">用法介紹</a>
        <a href="{{ url('message') }}">常見Q&A</a>
        </br>
        <a href="{{ url('message') }}">瘦身部落格</a>
        <a href="{{ url('message') }}">聯絡客服</a>
        <a href="{{ url('check') }}">訂單查詢</a>
    </div>
    <p class="copyright">{!! app('cache.config')->get('copyright') !!}</p>
    <div class="partner">
        <div class="icon"><img style="width: 5.2rem" src="{{ asset('static/img/ssl.png') }}" alt="ssl"></div>
        <div class="icon"><img style="width: 6.2rem" src="{{ asset('static/img/trusted.png') }}" alt="ssl"></div>
    </div>
</footer>


@section('footer-menu')
    <section class="footer-menu">
        <ul class="menu">
            <li>
                <a class="box" href="{{ url('/') }}">
                    <p class="ico"><i class="iconfont" style="font-size: 2.4rem">&#xe692;</i></p>
                    <p class="text">首頁</p>
                </a>
            </li>
            <li>
                <a class="box" href="{{ url('product') }}">
                    <p class="ico"><i class="iconfont">&#xe719;</i></p>
                    <p class="text">減肥藥購買</p>
                </a>
            </li>
            <li>
                <a class="box" href="{{ url('about') }}">
                    <p class="ico"><i class="iconfont" style="font-size: 2.4rem">&#xe8ca;</i></p>
                    <p class="text">用法介紹</p>
                </a>
            </li>
            <li>
                <a class="box" href="{{ url('faq') }}">
                    <p class="ico"><i class="iconfont">&#xeb90;</i></p>
                    <p class="text">常見Q&A</p>
                </a>
            </li>
            <li>
                <a class="box" href="{{ url('news') }}">
                    <p class="ico"><i class="iconfont" style="font-size: 2.7rem">&#xe602;</i></p>
                    <p class="text">瘦身部落格</p>
                </a>
            </li>
        </ul>
    </section>
@show
@section('customer-service')
    @if(request()->is('/'))
        <x-customer-service></x-customer-service>
    @endif
@show
</body>


@section('script')
    <script src="{{ asset('static/js/customer-service.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/observer.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.form.js') }}"></script>
    <script src="{{ asset('static/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/jcountdown/TweenMax.min.js') }}"></script>

    {!! app('cache.config')->get('google_ga') !!}

    <script>
        $('.show-menu').click(function () {
            $('.menu-section').addClass('-show');
            $('body').append('<div class="shade"></div>');
            $('body').addClass('overflow-hidden')
        });
        $('.close-menu').click(function(){
            $('.menu-section').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });

        $('body').on('click','.shade',function(){
            $('.menu-section').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });
    </script>

    <script type="text/javascript">
        // Create Countdown
        var Countdown = {

            // Backbone-like structure
            $el: $('.countdown'),

            // Params
            countdown_interval: null,
            total_seconds     : 0,

            // Initialize the countdown
            init: function() {

                // DOM
                this.$ = {
                    hours  : this.$el.find('.bloc-time.hours .figure'),
                    minutes: this.$el.find('.bloc-time.min .figure'),
                    seconds: this.$el.find('.bloc-time.sec .figure')
                };

                // Init countdown values
                this.values = {
                    hours  : this.$.hours.parent().attr('data-init-value'),
                    minutes: this.$.minutes.parent().attr('data-init-value'),
                    seconds: this.$.seconds.parent().attr('data-init-value'),
                };

                // Initialize total seconds
                this.total_seconds = this.values.hours * 60 * 60 + (this.values.minutes * 60) + this.values.seconds;

                // Animate countdown to the end
                this.count();
            },

            count: function() {

                var that    = this,
                    $hour_1 = this.$.hours.eq(0),
                    $hour_2 = this.$.hours.eq(1),
                    $min_1  = this.$.minutes.eq(0),
                    $min_2  = this.$.minutes.eq(1),
                    $sec_1  = this.$.seconds.eq(0),
                    $sec_2  = this.$.seconds.eq(1);

                this.countdown_interval = setInterval(function() {

                    if(that.total_seconds > 0) {

                        --that.values.seconds;

                        if(that.values.minutes >= 0 && that.values.seconds < 0) {

                            that.values.seconds = 59;
                            --that.values.minutes;
                        }

                        if(that.values.hours >= 0 && that.values.minutes < 0) {

                            that.values.minutes = 59;
                            --that.values.hours;
                        }

                        // Update DOM values
                        // Hours
                        that.checkHour(that.values.hours, $hour_1, $hour_2);

                        // Minutes
                        that.checkHour(that.values.minutes, $min_1, $min_2);

                        // Seconds
                        that.checkHour(that.values.seconds, $sec_1, $sec_2);

                        --that.total_seconds;
                    }
                    else {
                        clearInterval(that.countdown_interval);
                    }
                }, 1000);
            },

            animateFigure: function($el, value) {

                var that         = this,
                    $top         = $el.find('.top'),
                    $bottom      = $el.find('.bottom'),
                    $back_top    = $el.find('.top-back'),
                    $back_bottom = $el.find('.bottom-back');

                // Before we begin, change the back value
                $back_top.find('span').html(value);

                // Also change the back bottom value
                $back_bottom.find('span').html(value);

                // Then animate
                TweenMax.to($top, 0.8, {
                    rotationX           : '-180deg',
                    transformPerspective: 300,
                    ease                : Quart.easeOut,
                    onComplete          : function() {

                        $top.html(value);

                        $bottom.html(value);

                        TweenMax.set($top, { rotationX: 0 });
                    }
                });

                TweenMax.to($back_top, 0.8, {
                    rotationX           : 0,
                    transformPerspective: 300,
                    ease                : Quart.easeOut,
                    clearProps          : 'all'
                });
            },

            checkHour: function(value, $el_1, $el_2) {

                var val_1       = value.toString().charAt(0),
                    val_2       = value.toString().charAt(1),
                    fig_1_value = $el_1.find('.top').html(),
                    fig_2_value = $el_2.find('.top').html();

                if(value >= 10) {

                    // Animate only if the figure has changed
                    if(fig_1_value !== val_1) this.animateFigure($el_1, val_1);
                    if(fig_2_value !== val_2) this.animateFigure($el_2, val_2);
                }
                else {

                    // If we are under 10, replace first figure with 0
                    if(fig_1_value !== '0') this.animateFigure($el_1, 0);
                    if(fig_2_value !== val_1) this.animateFigure($el_2, val_1);
                }
            }
        };

        // Let's go !
        Countdown.init();
    </script>

@show
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>
</html>
