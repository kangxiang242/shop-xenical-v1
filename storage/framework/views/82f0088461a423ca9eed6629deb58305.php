<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($layout['seo'])): ?>
    <title><?php echo e(isset($layout['seo'])?$layout['seo']->title:""); ?></title>
    <?php else: ?>
    <?php if (! empty(trim($__env->yieldContent('title')))): ?>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php else: ?>
    <title><?php echo e(isset($layout['seo'])?$layout['seo']->title:""); ?></title>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('keywords')))): ?>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>"/>
    <?php else: ?>
    <meta name="keywords" content="<?php echo e(isset($layout['seo'])?$layout['seo']->key_word:""); ?>"/>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('description')))): ?>
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>"/>
    <?php else: ?>
    <meta name="description" content="<?php echo e(isset($layout['seo'])?$layout['seo']->description:""); ?>"/>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link rel="canonical" href="<?php echo e(config('app.url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>">
    <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo e(config('app.m_url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>">
    <link rel="shortcut icon" href="<?php echo e(\App\Services\ConfigService::get('favicon')?asset('uploads/'.\App\Services\ConfigService::get('favicon')):'/favicon.ico'); ?>">
    <?php $__env->startSection('style'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/style.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/common.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/global.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!is_googlebot()): ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/font_3122894_o33hqrxtwf/iconfont.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/swiper4/swiper.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('static/less/section.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('static/jcountdown/style.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('static/less/customer-service.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
    <?php echo $__env->yieldSection(); ?>


    <script src="<?php echo e(asset('static/js/jquery.min.js')); ?>"></script>

    <script src="<?php echo e(asset('static/jquery_lazyload/jquery.lazyload.min.js')); ?>"></script>

    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '<?php echo session()->get('flash'); ?>';

        if(flash_data){
            flash_data = JSON.parse('<?php echo session()->get('flash'); ?>');

        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("<?php echo e(\App\Services\ConfigService::get('freight_where',0)); ?>");
        var free_shipping_freight = parseInt("<?php echo e(\App\Services\ConfigService::get('freight',0)); ?>");

    </script>


</head>
<body>

<?php $__env->startSection('header'); ?>
<header>
    <div class="wrapper">
        <div class="logo-sec">
            <a href="<?php echo e(url('/')); ?>">
                <img width="280" src="<?php echo e(asset('static/img/logo.png')); ?>?ver=<?php echo e(config('app.asset_version')); ?>" alt="全球領先健康減肥藥">
            </a>
        </div>
        <div class="nav-sec">
            <ul class="base">
                <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
                <li><a href="<?php echo e(url('product')); ?>">減肥藥購買</a></li>
                <li><a href="<?php echo e(url('about')); ?>">用法介紹</a></li>
                <li><a href="<?php echo e(url('faq')); ?>">常見Q&A</a></li>
                <li><a href="<?php echo e(url('news')); ?>">瘦身部落格</a></li>

            </ul>

        </div>
    </div>
    <!-- <div class="tips">
        <p class="text"><?php echo e(app('cache.config')->get('countdown_text')); ?></p>
        <?php
            $h = str_pad(24-date('H'),2,'0',STR_PAD_LEFT);
            $i = str_pad(60-date('i'),2,'0',STR_PAD_LEFT);
            $s = str_pad(60-date('s'),2,'0',STR_PAD_LEFT);
        ?>
        <div class="countdown">
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
</header>
<?php echo $__env->yieldSection(); ?>


<?php $__env->startSection('banners'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout['banners'] && !$layout['banners']->isEmpty()): ?>
        <section class="banner-section">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $layout['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->img): ?>
                            <div class="swiper-slide">
                                <a href="<?php echo e($item->href?url($item->href):"javascript:;"); ?>"><img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->alt); ?>"></a>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php echo $__env->yieldContent('embed-banner'); ?>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php echo $__env->yieldSection(); ?>


<?php echo $__env->yieldContent('content'); ?>



<footer>

    <div class="safeguard">

        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 32px">&#xe6fc;</i></div>
            <p>歐洲進口</p>
        </div>
        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 26px">&#x100d2;</i></div>
            <p>原廠正品</p>
        </div>
        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 26px">&#xe609;</i></div>
            <p>現貨供應</p>
        </div>
        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 28px">&#xe714;</i></div>
            <p>當天發貨</p>
        </div>

        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 26px">&#xe6d0;</i></div>
            <p>隱密發貨</p>
        </div>
        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 26px">&#xe6ce;</i></div>
            <p>買家好評</p>
        </div>
        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 24px">&#xe6f5;</i></div>
            <p>免費退換</p>
        </div>
        <div class="co-item">
            <div class="icon-box"><i class="iconfont" style="font-size: 24px">&#xe6f8;</i></div>
            <p>安全結帳</p>
        </div>
    </div>

        
    
    <div class="partner">
        <div class="icon"><img  style="width: 50%" src="<?php echo e(asset('static/img/fdausa.png')); ?>" alt="fda-usa"></div>
        <div class="icon"><img style="width: 80%" src="<?php echo e(asset('static/img/ema.png')); ?>" alt="ema"></div>
        <!-- <div class="icon"><img  style="width: 65%" src="<?php echo e(asset('static/img/fdataiwan.png')); ?>" alt="台湾fda"></div> -->
        <div class="icon"><img  style="width: 10rem" src="<?php echo e(asset('static/img/CHEPLA.png')); ?>" alt="CHEPLA"></div>
        <!-- <div class="icon"><img  style="width: 9rem;" src="<?php echo e(asset('static/img/7-11.png')); ?>" alt="7-11"></div>
        <div class="icon"><img  style="width: 10rem;" src="<?php echo e(asset('static/img/heimao.png')); ?>" alt="黑猫宅急便"></div> -->
    </div>
    
    
    <div class="foot-nav">
        <ul>
            <li>
                <a href="<?php echo e(url('/')); ?>">羅氏鮮首頁</a>
            </li>
            <li>
                <a href="<?php echo e(url('product')); ?>">訂購專區</a>
            </li>
            <li>
                <a href="<?php echo e(url('about')); ?>">用法介紹</a>
            </li>
            <li>
                <a href="<?php echo e(url('faq')); ?>">常見Q&A</a>
            </li>
            <li>
                <a href="<?php echo e(url('news')); ?>">瘦身部落格</a>
            </li>
            <li>
                <a href="<?php echo e(url('check')); ?>">訂單查詢</a>
            </li>
            <li>
                <a href="<?php echo e(url('message')); ?>">聯繫客服</a>
            </li>
        </ul>
    </div>
    <div class="partner">
        <div class="icon"><img style="width: 4.2rem" src="<?php echo e(asset('static/img/ssl.png')); ?>" alt="ssl"></div>
        <div class="icon"><img style="width: 4.2rem" src="<?php echo e(asset('static/img/trusted.png')); ?>" alt="ssl"></div>
    </div>
    <p class="copyright"><?php echo app('cache.config')->get('copyright'); ?></p>
        
    
</footer>

<?php $__env->startSection('customer-service'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->is('/')): ?>
        <?php if (isset($component)) { $__componentOriginal894fdcda6f38a15005465578b27eb889 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal894fdcda6f38a15005465578b27eb889 = $attributes; } ?>
<?php $component = App\View\Components\CustomerService::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('customer-service'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CustomerService::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal894fdcda6f38a15005465578b27eb889)): ?>
<?php $attributes = $__attributesOriginal894fdcda6f38a15005465578b27eb889; ?>
<?php unset($__attributesOriginal894fdcda6f38a15005465578b27eb889); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal894fdcda6f38a15005465578b27eb889)): ?>
<?php $component = $__componentOriginal894fdcda6f38a15005465578b27eb889; ?>
<?php unset($__componentOriginal894fdcda6f38a15005465578b27eb889); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php echo $__env->yieldSection(); ?>

</body>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('static/js/customer-service.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>

<script src="<?php echo e(asset('static/js/observer.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
<script src="<?php echo e(asset('static/swiper4/swiper.min.js')); ?>"></script>
<script src="<?php echo e(asset('static/js/jquery.cookie.js')); ?>"></script>
<script src="<?php echo e(asset('static/js/cart.js')); ?>"></script>
<script src="<?php echo e(asset('static/js/xie.js')); ?>"></script>
<script src="<?php echo e(asset('static/jcountdown/TweenMax.min.js')); ?>"></script>
<?php echo \App\Services\ConfigService::get('google_ga'); ?>

<?php echo $__env->yieldSection(); ?>
<script>
    $(function(){
        setTimeout(function(){
            $('body').removeClass('-loading');
        },2000);
    })
</script>
<script>
    $('#back-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 500);
    })
</script>
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy").lazyload({effect: "fadeIn",placeholder:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAHYcAAB2HAY/l8WUAAAASSURBVBhXY/g/2+4/CEMZdv8BZwgLXT+0H34AAAAASUVORK5CYII='});
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


</html>
<?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/shop-xenical/shop-xenical-v1/resources/views/web/layout.blade.php ENDPATH**/ ?>