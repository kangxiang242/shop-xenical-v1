<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/index.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/product.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>

    <script>

        var Swiper5 = new Swiper('.swiper-container-news',{
            slidesPerView : 3,
            slidesPerGroup : 3,
            loop : true,
            pagination: {
                el: '.swiper-pagination-news',
                clickable :true,
            },
        })
    </script>
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <section class="ad-section">
        <img src="<?php echo e(asset_upload(app('cache.config')->get('home_page_banner'))); ?>" style="margin: 20px auto 0; border-radius: 20px;" alt="banner">
        <div class="wrap">
            <div class="major">
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
                <div class="spread">
                    <div class="col-left">
                        <img src="<?php echo e(asset_upload(app('cache.config')->get('home_adv_pc_1'))); ?>" alt="福利">
                    </div>
                    <div class="col-right">
                        <img src="<?php echo e(asset_upload(app('cache.config')->get('home_adv_pc_2'))); ?>" alt="福利2">
                    </div>
                </div>
            </div>
        </div>
        <section class="about-section">
            <div class="wrapper about">
                <div class="row ab-main"  >
                    <h1 class="ab-title"><?php echo app('cache.config')->get('home_about_title'); ?></h1>

                    <div class="text">
                        <?php echo app('cache.config')->get('home_about'); ?>

                    </div>
                </div>
            </div>
        </section>
    </section>



    <section class="product-section">

        <div class="wrap">
            <h2 class="title p-title">減肥藥購買</h2>
            <div class="main">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="goods" onclick="location.href='<?php echo e(url('product/'.$goods->id)); ?>'">

                        <div class="info scale-effect" >
                            <div class="goods-img"><a href="<?php echo e(url('product/'.$goods->id)); ?>"><img src="<?php echo e(asset('uploads/'.$goods->img)); ?>" alt="<?php echo e($goods->name); ?>" width="500" height="500"></a></div>
                            <div class="boa">
                                <p class="title"><a href="<?php echo e(url('product/'.$goods->id)); ?>"><?php echo e($goods->name); ?></a></p>
                                <!-- <p class="brief"><?php echo $goods->label; ?></p> -->
                                <div class="label">
                                    <span class="label-item"><?php echo e($goods->label); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->quantity >= 3): ?>
                                        <span class="label-item">限時優惠</span>
                                        <span class="label-item">免運費</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span class="label-item">無效可退</span>
                                    <span class="label-item">原廠正品</span>
                                </div>
                                <div class="price">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->quantity >= 3): ?>
                                        <p class="market">NT$ <?php echo e(number_format(round($goods->market_price))); ?></p>
                                    <?php else: ?>
                                        <p class="market" style="text-decoration: none !important;">官方售價</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <p class="now">NT$ <?php echo e(number_format(round($goods->price))); ?></p>
                                </div>
                                <a class="shop-btn" href="<?php echo e(url('checkout/'.$goods->id)); ?>" data-observer="免運訂購按鈕">
                                    <p >立即訂購</p>
                                    <i class="iconfont">&#xe719;</i>
                                </a>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



            </div>

        </div>
    </section>



    <div class="news-section">
        <div class="wrapper">
            <h2 class="news-title">瘦身部落格</h2>
            <div class="news-main">
                <div class="swiper-container swiper-container-news" style="min-height: 580px;">
                    <div class="swiper-wrapper clearfix" style="margin-top: 30px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="img-wrapper">
                                        <a href="<?php echo e(url('news/'.$item->id)); ?>"><img src="<?php echo e(asset_upload($item->img)); ?>" alt="<?php echo e($item->title); ?>"></a>
                                    </div>
                                    <div class="content">
                                        <div class="title-box">
                                            <h3 class="title"><a href="<?php echo e(url('news/'.$item->id)); ?>" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></a></h3>
                                        </div>

                                        <p class="desc"><?php echo e(\Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),116)); ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($news) > 3): ?>
                    <div class="swiper-pagination swiper-pagination-news"></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <section class="faq-section">
        <div class="wrapper">
            <h2 class="news-title">減肥藥常見問答</h2>
            <div class="fqa-body">
                <div class="question">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item question-show">
                            <p class="q-title">Q：<?php echo e($item->questions); ?></p>
                            <p class="q-desc"><?php echo e($item->answers); ?></p>
                            <i class="q-icon iconfont">&#xe775;</i>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </section>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app('cache.config')->get('promote_image')): ?>
        <section class="fraud-section">
            <div class="main">

                    <img width="100%" src="<?php echo e(asset_upload(app('cache.config')->get('promote_image'))); ?>" alt="隱私包裝">

            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/shop-xenical/shop-xenical-v1/resources/views/web/index.blade.php ENDPATH**/ ?>