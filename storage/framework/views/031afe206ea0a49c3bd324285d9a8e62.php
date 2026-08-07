<?php
    $comment_labels = $comment_labels->chunk(ceil(count($comment_labels)/3))
?>
<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/goods.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <style>
        header .tips{
            display: none;
        }
        .countdown .bloc-time:after{
            color: #000!important;
            font-weight: 500!important;
        }
        .red-pan{
            color: #d72525;
            letter-spacing: 0;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
        <li><a href="<?php echo e(url('product')); ?>">訂購專區</a></li>
        <li class="active"><?php echo e($product->name); ?></li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="goods-section">
        <div class="body">
            <!-- <iframe src="https://drive.google.com/file/d/1Ug3wJktyc0rhiv_JKbtg-1CqsgRTiLVV/view?usp=drive_link" width="800" height="800" allow="autoplay" frameborder="0"></iframe> -->
            <div class="card" style="background: none; margin-bottom: 0;">
                <div class="main">
                    <div class="goods">
                        <div class="atlas">
                            
                            <div class="thumbnail">
                                <div class="item active"><img src="<?php echo e(asset_upload($product->img)); ?>" alt="<?php echo e($product->name); ?>"></div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $goods_thumbnail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(array_get($item,'img')): ?>
                                        <div class="item"><img src="<?php echo e(asset_upload(array_get($item,'img'))); ?>" alt="<?php echo e($product->name); ?>"></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="cover-wrap">
                                <img src="<?php echo e(asset_upload($product->img)); ?>" alt="<?php echo e($product->name); ?>">
                            </div>
                        </div>
                        <div class="info">
                            <div class="name-wrap">
                                <!-- <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->price >= app('cache.config')->get('freight_where')): ?>
                                <span class="label">免運</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?> -->
                                <h1 class="title"><?php echo e($product->name); ?></h1>
                            </div>
                            <div class="label">
                                <span class="label-item"><?php echo e($goods->label); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->quantity >= 3): ?>
                                    <span class="label-item">限時優惠</span>
                                    <span class="label-item">免運費</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="label-item">無效可退</span>
                                <span class="label-item">原廠正品</span>
                            </div>
                            <!-- <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->attr): ?>
                                <div class="attrs">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $product->attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <dl>
                                            <dt><?php echo e($attr->name); ?>：</dt>
                                            <dd><?php echo e($attr->value); ?></dd>
                                        </dl>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?> -->
                            
                            <div class="prices">
                                <!-- <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->market_price > $product->price): ?>
                                <p class="market"><span>組合價NT$ <?php echo e(number_format(round($product->market_price))); ?></span></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?> -->
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->quantity >= 3): ?>
                                    <p class="market"><span>組合價 NT$ <?php echo e(number_format(round($product->market_price))); ?></span></p>
                                <?php else: ?>
                                    <p class="market" style="text-decoration: none !important;">官方售價</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <p class="now">
                                    <span class="sp">NT$ <?php echo e(number_format(round($product->price))); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->quantity >= 3): ?>
                                        <span class="lab">限時優惠</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </p>
                            </div>


                            <!-- <div class="g-countdown">
                                <p>回饋福利活動剩餘</p>
                                <?php
                                    $h = str_pad(24-date('H'),2,'0',STR_PAD_LEFT);
                                    $i = str_pad(60-date('i'),2,'0',STR_PAD_LEFT);
                                    $s = str_pad(60-date('s'),2,'0',STR_PAD_LEFT);
                                ?>
                                <div class="goods-countdown countdown">
                                    <div class="bloc-time hours" data-init-value="<?php echo e((int)$h); ?>">


                                        <div class="figure hours hours-1">
                                            <span class="top" style="transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);"><?php echo e(substr($h,0,1)); ?></span>
                                            <span class="top-back">
                                              <span><?php echo e(substr($h,0,1)); ?></span>
                                            </span>
                                            <span class="bottom"><?php echo e(substr($h,0,1)); ?></span>
                                            <span class="bottom-back">
                                              <span><?php echo e(substr($h,0,1)); ?></span>
                                            </span>
                                        </div>

                                        <div class="figure hours hours-2">
                                            <span class="top" style="transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);"><?php echo e(substr($h,-1)); ?></span>
                                            <span class="top-back">
                                              <span><?php echo e(substr($h,-1)); ?></span>
                                            </span>
                                            <span class="bottom"><?php echo e(substr($h,-1)); ?></span>
                                            <span class="bottom-back">
                                              <span><?php echo e(substr($h,-1)); ?></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="bloc-time min" data-init-value="<?php echo e((int)$i); ?>">


                                        <div class="figure min min-1">
                                            <span class="top"><?php echo e(substr($i,0,1)); ?></span>
                                            <span class="top-back">
                                              <span><?php echo e(substr($i,0,1)); ?></span>
                                            </span>
                                            <span class="bottom"><?php echo e(substr($i,0,1)); ?></span>
                                            <span class="bottom-back">
                                              <span><?php echo e(substr($i,0,1)); ?></span>
                                            </span>
                                        </div>

                                        <div class="figure min min-2">
                                            <span class="top"><?php echo e(substr($i,-1)); ?></span>
                                            <span class="top-back">
                                              <span><?php echo e(substr($i,-1)); ?></span>
                                            </span>
                                            <span class="bottom"><?php echo e(substr($i,-1)); ?></span>
                                            <span class="bottom-back">
                                              <span><?php echo e(substr($i,-1)); ?></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="bloc-time sec" data-init-value="<?php echo e((int)$s); ?>">
                                        <div class="figure sec sec-1">
                                            <span class="top"><?php echo e(substr($s,0,1)); ?></span>
                                            <span class="top-back">
                                              <span><?php echo e(substr($s,0,1)); ?></span>
                                            </span>
                                            <span class="bottom"><?php echo e(substr($s,0,1)); ?></span>
                                            <span class="bottom-back">
                                              <span><?php echo e(substr($s,0,1)); ?></span>
                                            </span>
                                        </div>

                                        <div class="figure sec sec-2">
                                            <span class="top"><?php echo e(substr($s,-1)); ?></span>
                                            <span class="top-back">
                                              <span><?php echo e(substr($s,-1)); ?></span>
                                            </span>
                                            <span class="bottom"><?php echo e(substr($s,-1)); ?></span>
                                            <span class="bottom-back">
                                              <span><?php echo e(substr($s,-1)); ?></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <p class="prescription">下單成功後最慢<span class="red-pan">3個工作日</span>內出貨</p> -->
                            <div class="views">
                                
                                <p class="view"><i class="iconfont">&#xe6d4;</i><span id="randomNumber"></span>人正在瀏覽</p>
                                <p class="comment" style="display: none;">最新客評2萬+<i class="iconfont">&#xe6ce;</i></p>
                            </div>
                            <div class="card">

                                <div class="ensures">
                                    <div class="icons">
                                        <p class="ioc"><i class="iconfont" style="transform: translateX(-0.2rem); margin-right: 0;">&#xe6c1;</i><span>限時優惠</span></p>
                                        <p class="ico-sub">距本次優惠活動結束還有 <span id="targetTimestamp" style="display: inline-block; width: 72px;"></span></p>
                                    </div>
                                    <div class="icons">
                                        <p class="ioc"><i class="iconfont">&#xe6d0;</i><span>現貨供應</span></p>
                                        <p class="ico-sub">官方配送預計&nbsp;<span style="color: #000;"><?php echo e(date('n月d日',strtotime('+2 day'))); ?></span>&nbsp;即可送到指定地址</p>
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
                            <div class="sales">
                                
                                <p class="panic">已搶購&nbsp;<span class="red-pan" id="buy_num">713</span>&nbsp;份</p>
                                
                                <div class="order-logs">
                                    <div class="swiper-container" id="order-logs-swiper">
                                        <div class="swiper-wrapper">

                                        </div>
                                    </div>

                                </div>
                                <div style="display: none">
                                    <div class="swiper-button-prev" id="order-logs-prev"></div>
                                    <div class="swiper-button-next" id="order-logs-next"></div>
                                </div>
                            </div>

                            
                            <a class="place" href="<?php echo e(url('checkout/'.$product->id)); ?>" data-observer="免運訂購按鈕">
                                <p >立即訂購</p>
                                <i class="iconfont">&#xe719;</i>
                            </a>
                            

                            <!-- <div class="ensures">
                                <div class="icons">
                                    <span class="ioc"><i class="iconfont">&#xeb67;</i></span>
                                    <span>官方授權</span>
                                </div>
                                <div class="icons">
                                    <span class="ioc"><i class="iconfont">&#xe624;</i></span>
                                    <span>免費換貨</span>
                                </div>
                                <div class="icons">
                                    <span class="ioc"><i class="iconfont">&#xe88c;</i></span>
                                    <span>安全結帳</span>
                                </div>
                            </div> -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($discount && !$discount->isEmpty()): ?>
                                <div class="card">
                                    <div class="main">
                                        <div class="programme">
                                            <div class="content">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>升級組合更優惠</th>
                                                            <th>平均一盒</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $discount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <p><?php echo e($item->name); ?></p>
                                                                    
                                                                    <p class="sp">NT$<?php echo e(number_format(round($item->price))); ?>

                                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->quantity >= 3): ?>
                                                                            <span class="market">NT$<?php echo e(number_format(round($item->market_price))); ?></span>
                                                                        <?php else: ?>
                                                                            <span class="market" style="text-decoration: none !important;">官方售價</span>
                                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                        
                                                                    </p>
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>NT$<?php echo e(number_format(round($item->price/$item->quantity))); ?></td>
                                                            <td><a class="choice" href="<?php echo e(url('product/'.$item->id)); ?>" data-observer="選擇該方案-<?php echo e($item->name); ?>">升級組合</a></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="share">
                                <p class="sharetext">分享我們：</p>
                                <div class="social">

                                    <a href="https://line.me/R/msg/text/?Xenical羅氏鮮®%20<?php echo e(request()->fullUrl()); ?>" target="_blank">
                                        <i class="iconfont social-icon">&#xebf5;</i>
                                    </a>
                                    <a href="https://www.instagram.com/share.php?text=Xenical羅氏鮮®&url=https%3A%2F%2F<?php echo e(request()->fullUrl()); ?>" target="_blank">
                                        <i class="iconfont social-icon">&#xe88f;</i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(request()->fullUrl()); ?>&text=Xenical羅氏鮮®" target="_blank">
                                        <i class="iconfont social-icon">&#xe6f0;</i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(request()->fullUrl()); ?>" target="_blank">
                                        <i class="iconfont social-icon">&#xebfc;</i>
                                    </a>


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
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $goods_instructions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div class="ls">
                                            <span class="s1"><?php echo e(array_get($val,'name')); ?></span>
                                            <span class="s2"><?php echo e(array_get($val,'value')); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                

                
            
            


            <div class="card" style="display: none;">
                <div class="main">
                    <div class="comments">
                        <p class="title">最新買家評價<span style="letter-spacing: 0;"> (23950)</span></p>
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
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $comment_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="label"><?php echo e($item->name); ?></div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>

                                            
                                        </div>


                                    </div>

                                    <div class="history">
                                        <!-- <div class="info-item-header">
                                            <span>最新買家評價</span>
                                        </div> -->

                                        <div class="reviews">

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="rev">
                                                    <div class="name-box"> 
                                                        <div class="nickname">
                                                            <p>買家09****<?php echo e(substr($item->phone,-4)); ?></p>
                                                            <p class="buy-text">本次訂購<span><?php echo e($item->current_purchase); ?>盒</span></p>
                                                        </div>
                                                        
                                                        <p class="today"><?php echo e($item->time_at); ?></p>   
                                                    </div>
                                                    <div class="star-box">
                                                        
                                                        <div class="row">
                                                            <div class="frequency">效果描述</div>
                                                            <div class="stars">
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont"><?php echo e($item->target1 == 4 ? "&#xe9a2;" : ($item->target1 == 4.5 ? "&#xe9a3;" : "&#xe9a1;")); ?></i>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="frequency">配送速度</div>
                                                            <div class="stars">
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont"><?php echo e($item->target2 == 4 ? "&#xe9a2;" : ($item->target2 == 4.5 ? "&#xe9a3;" : "&#xe9a1;")); ?></i>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="frequency">賣家服務</div>
                                                            <div class="stars">
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont">&#xe9a1;</i>
                                                                <i class="iconfont"><?php echo e($item->target3 == 4 ? "&#xe9a2;" : ($item->target3 == 4.5 ? "&#xe9a3;" : "&#xe9a1;")); ?></i>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    

                                                    <p class="content">
                                                        <?php echo e($item->content); ?>

                                                    </p>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->comment_image): ?>
                                                    <img class="content-pic" src="<?php echo e(asset_upload($item->comment_image)); ?>">
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <!-- <div class="like-box">
                                                        
                                                        <div class="up awesome" data-id="<?php echo e($item->id); ?>" data-up="<?php echo e($item->up); ?>"></div>
                                                        <span class="up-num">(<?php echo e($item->up); ?>)</span>
                                                    </div> -->
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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

            <div class="card">
                <div class="main">
                    <div class="delivery">
                        <p class="title">配送說明</p>
                        <div class="content">
                            <?php echo app('cache.config')->get('goods_delivery'); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="main">
                    <div class="delivery">
                        <p class="title">付款說明</p>
                        <div class="content">
                            <?php echo app('cache.config')->get('goods_payment'); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="main">
                    <div class="delivery">
                        <p class="title">售後說明</p>
                        <div class="content">
                            <?php echo app('cache.config')->get('goods_after_sales'); ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/shop-xenical/shop-xenical-v1/resources/views/web/product/show.blade.php ENDPATH**/ ?>