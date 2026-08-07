@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/goods.css') }}?ver={{ config('app.asset_version') }}">
    <style>
        .countdown .bloc-time:after{
            color: #000;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 0 0.4rem 0 0.2rem;
        }
        .red-pan{
            color: #d72525;
        }
        .countdown .figure > span{
            font-size: 1.3rem;
            line-height: 1.66rem;
        }
        .countdown .figure .top {
            background-color: #f0f1f2;
        }
        .countdown .figure .top-back {
            background-color: #f0f1f2;
        }
        .countdown .figure {
            border-radius: 0.3rem;
            height: 1.6rem;
            width: 1rem;
            margin-right: 0.1rem;
            background-color: #f0f1f2;

        }
        .order-logs .swiper-container{
            z-index: 0;
        }
    </style>
@stop


@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li><a href="{{ url('product') }}">線上訂購</a></li>
        <li class="active">{{ \Illuminate\Support\Str::limit($product->name,20) }}</li>
    </ul>
@stop

@section('script')
    @parent
    <script>
        $('.thumbnail .item').click(function(){
            var src = $(this).find('img').attr('src');
            $('.cover-wrap').find('img').attr('src',src);
            $(this).addClass('active').siblings().removeClass('active');
        });
    </script>
    <script type="text/javascript">
        // Create Countdown
        var Countdown = {

            // Backbone-like structure
            $el: $('.goods-countdown'),

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
    <script>
        function makeOrderLogs(){
            var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
            var current_time = Date.parse(new Date())/1000;


            var swiper_html = '';
            if(order_log_time>current_time){

                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+localStorage.getItem("order_log_nickname")+'</span><span class="time">剛剛</span></p></div>';
            }
            for(var i=0;i<10;i++){
                var str = "買家09****"+getRandomNum()+"已下單";
                var time = "剛剛";
                //order_logs.push({'nickname':str,'time':time});

                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+str+'</span><span class="time">'+time+'</span></p></div>';
            }
            $('#order-logs-swiper').find('.swiper-wrapper').html(swiper_html);


        }
        makeOrderLogs();
        function getRandomNum(){
            var randomNum = Math.random()

            var checkCode = randomNum*9000
            checkCode +=1000;
            return parseInt(checkCode)
        }

        function getRandomInt(min,max){
            return Math.floor(Math.random()*(max-min+1))+min;
        }

        var is_run = false;
        setInterval(function(){
            var time = getRandomInt(8,25)*1000;


            if(!is_run){
                is_run = true;

                setTimeout(function(){
                    localStorage.removeItem("order_log_time");
                    $('#order-logs-next').click();
                    is_run=false;

                },time)
            }


        },1000)


        var current_order_buy_num = parseInt(localStorage.getItem("order_buy_num"));
        if(current_order_buy_num){
            $('#buy_num').text(current_order_buy_num);
        }


        var mySwiper = new Swiper('#order-logs-swiper', {
            autoplay: false,
            loop:true,
            simulateTouch : false,
            allowTouchMove: false,
            direction: 'vertical',
            observer: true,
            navigation: {
                nextEl: '#order-logs-next',
            },
            on: {
                slideChangeTransitionStart: function(swiper){
                    var str = $('#order-logs-swiper .swiper-slide').eq(this.activeIndex).find('.nick').text();
                    localStorage.setItem("order_log_nickname",str);

                    var order_buy_num = parseInt(localStorage.getItem("order_buy_num"));
                    if(!order_buy_num){
                        order_buy_num = parseInt($('#buy_num').text());

                    }


                    var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
                    var current_log_time = Date.parse(new Date())/1000;
                    if(!order_log_time || current_log_time>order_log_time){
                        localStorage.setItem("order_log_time",Date.parse(new Date())/1000);
                        localStorage.setItem("order_buy_num",order_buy_num+1);

                        $('#buy_num').text(order_buy_num+1);
                    }





                },
            },
        })
    </script>

    <script>

        var today = new Date();
        // 设置时间为 20:00:00
        today.setHours(20, 0, 0, 0);
        // 获取时间戳
        var targetTimestamp = today.getTime();

        const countdownElement = document.getElementById('targetTimestamp');

        function updateCountdown() {
            // 获取当前时间的时间戳
            const currentTimestamp = new Date().getTime();

            // 计算剩余时间（以毫秒为单位）
            const remainingTime = targetTimestamp - currentTimestamp;


            // 将剩余时间转换为天、小时、分钟、秒
            const hours = String(Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
            const minutes = String(Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
            const seconds = String(Math.floor((remainingTime % (1000 * 60)) / 1000)).padStart(2, '0');
            const milliseconds = String(Math.floor(remainingTime % 1000)).charAt(0);

            // 更新倒计时显示
            countdownElement.innerHTML = `${hours}:${minutes}:${seconds}:${milliseconds}`;



            // 每秒更新一次倒计时
            setTimeout(updateCountdown);
        }

        // 初始调用来启动倒计时
        updateCountdown();

    </script>
    <script>
        var page = 5;

        var currentPage = 1;
        var count = $('.rev').length;
        var pageNumber = Math.ceil(count/page);

        var pageLinkRender = function () {
            $('.history').append('<ul class="paging" id="paging"></ul>')
            var temp = '<li class="prev"><svg t="1695783674431" class="previcon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4168" width="200" height="200"><path d="M563.626667 490.666667L298.666667 229.376 358.186667 170.666667 682.666667 490.666667 358.186667 810.666667 298.666667 751.957333z" p-id="4169"></path></svg></li>';
            for (var i=0;i<pageNumber;i++){
                temp += '<li class="turn '+(i==0?'active':'')+'" data-page="'+(i+1)+'"><span>'+(i+1)+'</span></li>'
            }
            temp += '<li>···</li><li class="next"><svg t="1695783674431" class="nexticon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4168" width="200" height="200"><path d="M563.626667 490.666667L298.666667 229.376 358.186667 170.666667 682.666667 490.666667 358.186667 810.666667 298.666667 751.957333z" p-id="4169"></path></svg></li>';
            $('#paging').html(temp)
        }
        if(pageNumber>1){
            //pageLinkRender();
        }
        $('.rev').hide();
        var showLinkPage = function (show_page) {

            $('.rev').hide()
            var show_page = parseInt(show_page);
            for(var i=0;i<page;i++){
                var eq = i+(show_page-1)*page
                var rev = $('.rev').eq(eq);
                if(rev){
                    rev.show();
                }
            }
            currentPage = show_page;

            $("[data-page='"+show_page+"']").addClass('active').siblings().removeClass('active');


            $('#paging .prev').removeClass('disabled')
            $('#paging .next').removeClass('disabled')
            if(currentPage <= 1){
                $('#paging .prev').addClass('disabled');
            }
            if(currentPage >= pageNumber){
                $('#paging .next').addClass('disabled');
            }

        }
        showLinkPage(1);
        $('#paging .turn').click(function () {
            if(!$(this).hasClass('active')){
                var show_page = $(this).attr('data-page');
                showLinkPage(show_page);

            }
        })

        $('#paging .next').click(function () {
            let nextPage = currentPage+1;
            if(nextPage<=pageNumber){
                $('.reviews .loading').addClass('active')
                setTimeout(function () {
                    showLinkPage(nextPage)
                    $('.reviews .loading').removeClass('active')
                },500)

            }

        })

        $('#paging .prev').click(function () {
            let prevPage = currentPage-1;
            if(prevPage>=1){
                $('.reviews .loading').addClass('active')
                setTimeout(function () {
                    showLinkPage(prevPage)
                    $('.reviews .loading').removeClass('active')
                },500)
            }

        })

        $('.lord-more').click(function (){
            var nextPage = currentPage+1;
            if(nextPage<=pageNumber){
                showLinkPage(nextPage)
            }

            if(nextPage==pageNumber){
                $('.lord-more').hide();
            }

        })


    </script>

    <script>
        function updateRandomNumber() {

            var randomNumber = Math.floor(Math.random() * (80 - 20 + 1)) + 20;


            document.getElementById('randomNumber').innerText = randomNumber;
        }

        var randomInterval = Math.floor(Math.random() * (20 - 10 + 1)) + 10;
       

        setTimeout(updateRandomNumber, randomInterval * 1000);

        updateRandomNumber();
    </script>
@stop

@section('footer-menu')
@stop

@section('content')
    <section class="goods-section">
        <div class="body">

            <div class="card">
                <div class="main">
                    <div class="goods">
                        <div class="atlas">
                            <div class="cover-wrap">
                                <img src="{{ asset_upload($product->img) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="thumbnail">
                                <div class="item active"><img src="{{ asset_upload($product->img) }}" alt="{{ $product->name }}"></div>
                                @foreach(array_values($goods_thumbnail) as $key=>$item)
                                    @if($key<2)
                                        <div class="item"><img src="{{ asset_upload(array_get($item,'img')) }}" alt="{{ $product->name }}"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="info">
                            <div class="name-wrap">
                                <!-- @if($product->price >= app('cache.config')->get('freight_where'))
                                    <span class="label">免運</span>
                                @endif -->
                                <h1>{{ $product->name }}</h1>
                                <div class="label">
                                    <span class="label-item">{{ $goods->label }}</span>
                                    @if($goods->quantity >= 3)
                                        <span class="label-item">限時優惠</span>
                                        <span class="label-item">免運費</span>
                                    @endif
                                    <span class="label-item">無效可退</span>
                                    <span class="label-item">原廠正品</span>
                                </div>
                            </div>
                            <div class="views">
                                <p class="view"><i class="iconfont">&#xe6d4;</i><span id="randomNumber"></span>人正在瀏覽</p>
                                <p class="comment" style="display: none;">最新客評2萬+<i class="iconfont">&#xe6ce;</i></p>
                            </div>
                            <div class="prices">
                                
                                <div class="sales">
                                    <div class="panic">
                                        <p class="s1">已搶購&nbsp;<span class="red-pan" style="font-style: normal" id="buy_num">713</span>&nbsp;份
                                        </p>
                                    </div>
                                    <div class="order-logs">
                                        <div class="swiper-container" id="order-logs-swiper" style="z-index: 0">
                                            <div class="swiper-wrapper">

                                            </div>
                                        </div>

                                    </div>
                                    <div style="display: none">
                                        <div class="swiper-button-prev" id="order-logs-prev"></div>
                                        <div class="swiper-button-next" id="order-logs-next"></div>
                                    </div>
                                </div>
                                
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            
            

            <div class="card">
                <div class="main">
                    <div class="main">
                        <div class="goods">

                            <div class="info">

                                <!-- @if($product->attr)
                                    <div class="attrs">
                                        @foreach($product->attr as $attr)
                                            <dl>
                                                <dt>{{ $attr->name }}：</dt>
                                                <dd>{{ $attr->value }}</dd>
                                            </dl>
                                        @endforeach
                                    </div>
                                @endif


                                <p class="prescription">下單成功後最慢<span class="red-pan">3個工作日</span>內出貨</p> -->

                                

                                <div class="ensures">
                                    <div class="icons">
                                        <p class="ioc"><i class="iconfont" style="transform: translateX(-0.2rem); margin-right: 0; font-size: 1.9rem;">&#xe6c1;</i><span>限時優惠</span></p>
                                        <p class="ico-sub">距本次優惠活動結束還有 <span id="targetTimestamp" style="display: inline-block; text-align: left; width: 6.1rem;">10:20:31:9</span></p>
                                    </div>
                                    <div class="icons">
                                        <p class="ioc"><i class="iconfont">&#xe6d0;</i><span>現貨供應</span></p>
                                        <p class="ico-sub">官方配送預計&nbsp;{{ date('n月d日',strtotime('+2 day')) }}&nbsp;即可送到指定地址</p>
                                    </div>
                                    <div class="icons">
                                        <p class="ioc"><i class="iconfont">&#xe70a;</i><span>正品保證</span></p>
                                        <p class="ico-sub">歐洲原廠正品授權進口</p>
                                    </div>
                                    <div class="icons">
                                        <p class="ioc"><i class="iconfont">&#xe6b9;</i><span>免費退換</span></p>
                                        <p class="ico-sub">七天鑑賞期內可免費退換</p>
                                    </div>
                                    <div class="icons">
                                        <p class="ioc"><i class="iconfont">&#xe73f;</i><span>安全結帳</span></p>
                                        <p class="ico-sub">安全支付&加密保護顧客購買訊息</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="card">
                <div class="main">
                    <div class="final">
                        <div class="content">
                            <div class="instructions">
                                <p class="title">藥品說明</p>
                                <div class="present">
                                    @foreach($goods_instructions as $val)

                                        <div class="ls">
                                            <span class="s1">{{ array_get($val,'name') }}</span>
                                            <span class="s2">{{ array_get($val,'value') }}</span>
                                        </div>
                                    @endforeach




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($discount && !$discount->isEmpty())
                <div class="card">
                    <div class="main">
                        <div class="programme">
                            <div class="content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="font-size: 1.6rem; font-weight: 500;">升級組合更優惠</th>
                                            <th>平均一盒</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($discount as $item)
                                        <tr>
                                            <td>
                                                <div>
                                                    <p>{{ $item->name }}</p>
                                                    
                                                    <p class="sp">NT${{ number_format(round($item->price)) }}
                                                        @if($item->quantity >= 3)
                                                            <span class="market">NT${{ number_format(round($item->market_price)) }}</span>
                                                        @else
                                                            <span class="market" style="text-decoration: none !important;">官方售價</span>
                                                        @endif
                                                        
                                                    </p>
                                                    
                                                </div>
                                            </td>
                                            <td>
                                                <p>NT${{ number_format(round($item->price/$item->quantity)) }}</p>
                                                <a class="choice" href="{{ url('product/'.$item->id) }}" data-observer="選擇該方案-{{ $item->name }}">升級組合</a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="share">
                <p class="sharetext">分享我們：</p>
                <div class="social">

                    <a href="https://line.me/R/msg/text/?Xenical羅氏鮮®%20{{ request()->fullUrl() }}" target="_blank">
                        <i class="iconfont social-icon">&#xebf5;</i>
                    </a>
                    <a href="https://www.instagram.com/share.php?text=Xenical羅氏鮮®&url=https%3A%2F%2F{{ request()->fullUrl() }}" target="_blank">
                        <i class="iconfont social-icon">&#xe88f;</i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ request()->fullUrl() }}&text=Xenical羅氏鮮®" target="_blank">
                        <i class="iconfont social-icon">&#xe6f0;</i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->fullUrl() }}" target="_blank">
                        <i class="iconfont social-icon">&#xebfc;</i>
                    </a>


                </div>
            </div>

            <div class="card">
                <div class="main">
                    <div class="delivery">
                        <p class="title">配送說明</p>
                        <div class="content">
                            <div class="col">
                                <div class="enu">
                                    {!! app('cache.config')->get('goods_delivery') !!}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="main">
                    <div class="delivery">
                        <p class="title">付款說明</p>
                        <div class="content">
                            <div class="col">
                                <div class="enu">
                                    {!! app('cache.config')->get('goods_payment') !!}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="main">
                    <div class="delivery">
                        <p class="title">售後說明</p>
                        <div class="content">
                            <div class="col">
                                <div class="enu">
                                    {!! app('cache.config')->get('goods_after_sales') !!}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="card" style="display: none;">
                <div class="main">
                    <div class="comments">
                        <p class="title">最新買家評價<span style="letter-spacing: 0;">（23950）</span></p>
                        <div class="content">
                            <div class="comment-box" id="target">

                                <div class="comment">
                                    <div class="widg">
                                        <div class="amount-wrap">
                                            <div class="total-box">


                                                <div class="total">

                                                    <p class="score">4.7<span class="all">/5</span></p>
                                                    <div class="stars">
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a3;</i>
                                                    </div>

                                                </div>
                                                <div class="histogram">
                                                    <div class="row">
                                                        <div class="frequency">效果描述</div>
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a3;</i>
                                                        </div>
                                                        <div class="percentage">4.8</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="frequency">配送速度</div>
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a3;</i>
                                                        </div>
                                                        <div class="percentage">4.8</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="frequency">賣家服務</div>
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a3;</i>
                                                        </div>
                                                        <div class="percentage">4.5</div>
                                                    </div>
                                                    <!-- <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: 90%"></span></div>
                                                        <div class="percentage">100%</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: 90%"></span></div>
                                                        <div class="percentage">90%</div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="label-sec">
                                                @foreach($comment_labels as $chunk)

                                                    @foreach($chunk as $item)
                                                        <div class="label">{{ $item->name }}</div>
                                                    @endforeach

                                                @endforeach
                                            </div>


                                        </div>


                                    </div>

                                    <div class="history">
                                        <!-- <div class="info-item-header">
                                            <span>最新買家評價</span>
                                        </div> -->

                                        <div class="reviews">

                                            @foreach($comment as $item)
                                                <div class="rev">
                                                    <div class="name-box">
                                                        <div class="nickname">
                                                            <p>買家09****{{ substr($item->phone,-4) }}</p>
                                                            <p class="buy-text">本次已購 <span>{{ $item->current_purchase }}盒</span></p>
                                                        </div>

                                                        <p class="today">{{ $item->time_at }}</p>
                                                    </div>
                                                    <div class="star-box">

                                                        <div class="row">
                                                            <div class="frequency">效果描述</div>
                                                            <div class="stars">
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">{{ $item->target1 == 4 ? "&#xe9a2;" : ($item->target1 == 4.5 ? "&#xe9a3;" : "&#xe9a1;") }}</i>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="frequency">配送速度</div>
                                                            <div class="stars">
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">{{ $item->target2 == 4 ? "&#xe9a2;" : ($item->target2 == 4.5 ? "&#xe9a3;" : "&#xe9a1;") }}</i>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="frequency">賣家服務</div>
                                                            <div class="stars">
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">{{ $item->target3 == 4 ? "&#xe9a2;" : ($item->target3 == 4.5 ? "&#xe9a3;" : "&#xe9a1;") }}</i>
                                                            </div>
                                                        </div>


                                                    </div>


                                                    <p class="content">
                                                        {{ $item->content }}
                                                    </p>
                                                    @if($item->comment_image)
                                                        <img class="content-pic" src="{{ asset_upload($item->comment_image) }}">
                                                @endif
                                                <!-- <div class="like-box">

                                                        <div class="up awesome" data-id="{{ $item->id }}" data-up="{{ $item->up }}"></div>
                                                        <span class="up-num">({{ $item->up }})</span>
                                                    </div> -->
                                                </div>
                                            @endforeach

                                            <div class="loading" ><img src="/static/img/loading.svg" alt="loading"></div>
                                        </div>

                                        <div class="switch" id="paging">
                                            <a class="prev" id="comment-prev" href="javascript:;">上一頁</a>
                                            <a class="next" id="comment-next" href="javascript:;">下一頁</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

        </div>
    </section>

    <section class="footer-shopping">

        <a class="go-shop" href="{{ url('checkout/'.$product->id) }}" data-observer="立即購買">
            <div class="p-row">
                <!-- @if($product->market_price > $product->price)
                    <p class="market">組合價 NT$ {{ number_format(round($product->market_price)) }}</p>
                @endif -->
                @if($product->quantity >= 3)
                    <p class="market">組合價 NT$ {{ number_format(round($product->market_price)) }}</p>
                @else
                    <p class="market" style="text-decoration: none !important;">官方售價</p>
                @endif
                <div class="g-tips">
                    <p class="now"><span class="sp">NT$ {{ number_format(round($product->price)) }}</span>
                        @if($product->quantity >= 3)
                            <span class="lab">限時優惠</span>
                        @endif
                    </p>
                </div>
            </div>
            <p class="b-row">立即訂購</p>
        </a> 
        
    </section>
@endsection
