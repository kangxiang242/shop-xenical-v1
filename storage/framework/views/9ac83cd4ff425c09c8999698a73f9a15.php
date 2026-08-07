<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/news.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/pagination.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>

        <li class="active">瘦身部落格</li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-content wrapper">

            <h1 class="page-title">瘦身部落格</h1>
            <div class="main">
                <div class="news">
                    <div class="news-vse">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="img-wrapper"><a href="<?php echo e(url('news/'.$item->id)); ?>"><img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->img_alt?:$item->title); ?>" oncontextmenu="return false;"></a></div>
                                <div class="info">
                                    <p class="new-title"><a href="<?php echo e(url('news/'.$item->id)); ?>"><?php echo e($item->title); ?></a></p>
                                    <p class="new-desc">
                                        <?php echo e(\Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),240)); ?>

                                    </p>
                                    <p class="go"><a class="go-btn" href="<?php echo e(url('news/'.$item->id)); ?>">閱讀全文 >></a></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="page">
                        <?php echo $news->links(); ?>

                    </div>
                </div>

                <div class="popularity">
                    <div class="popularity-row">
                        <div class="box-header">
                            <a class="title" href="javascript:;">最新資訊</a>
                        </div>
                        <div class="popularity-product popularity-title-edition">

                            <div class="list">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $newNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="list-item">
                                        <a class="main-color-hover" href="<?php echo e(url('news/'.$item->id)); ?>"><?php echo e($item->title); ?></a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/shop-xenical/shop-xenical-v1/resources/views/web/news/index.blade.php ENDPATH**/ ?>