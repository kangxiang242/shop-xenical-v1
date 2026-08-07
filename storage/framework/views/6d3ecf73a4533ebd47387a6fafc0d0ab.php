<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/product.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
        <li class="active">減肥藥購買</li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="product-section">

    <div class="wrap">
        <h1 class="title p-title">減肥藥購買</h1>
        <div class="main">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="goods" onclick="window.location.href='<?php echo e(url('product/'.$goods->id)); ?>'">

                    <div class="info scale-effect" >
                        <div class="goods-img"><a href="<?php echo e(url('product/'.$goods->id)); ?>"><img src="<?php echo e(asset('uploads/'.$goods->img)); ?>" alt="<?php echo e($goods->name); ?>"></a></div>
                        <div class="boa">
                            <h2 class="title"><a href="<?php echo e(url('product/'.$goods->id)); ?>"><?php echo e($goods->name); ?></a></h2>
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
        <div class="product-description">
            <p class="description-warp">
                <?php echo app('cache.config')->get('page_product_desc'); ?>

            </p>
        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/shop-xenical/shop-xenical-v1/resources/views/web/product/index.blade.php ENDPATH**/ ?>