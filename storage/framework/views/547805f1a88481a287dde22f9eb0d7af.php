<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->seo_title): ?>
    <?php $__env->startSection('title', $news->seo_title); ?>
<?php else: ?>
    <?php $__env->startSection('title', $news->title); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->seo_keyword): ?>
    <?php $__env->startSection('keywords', $news->seo_keyword); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->seo_description): ?>
    <?php $__env->startSection('description', $news->seo_description); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/news-desc.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script>
        document.domain = "<?php echo e(getMainDomain()); ?>";
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
        <li><a href="<?php echo e(url('news')); ?>">瘦身部落格</a></li>
        <li class="active"><?php echo e($news->title); ?></li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container clearfix">



            <div class="news" style="margin-top: 90px;    padding-bottom: 50px;">
                <div class="news-main clearfix">
                    <h1 class="title"><?php echo e($news->title); ?></h1>
                    <div class="division">
                        
                        <span class="time" style="float: unset"><?php echo e($news->release_at->format('Y-m-d')); ?></span>
                    </div>
                    <div class="new-content">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->html_file): ?>
                            <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="<?php echo e(asset_upload(str_replace('.zip','',$news->html_file).'/index.html')); ?>"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
                        <?php else: ?>
                            <?php echo $news->content; ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>
                    <div class="relevant clearfix">

                        <div class="prev">
                            <p class="pte">上一篇</p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prev): ?>
                                <div class="relevant-news clearfix">
                                   
                                    <p class="title-hover" style="    width: 300px;margin: 0"><a href="<?php echo e(url('news/'.$prev->id)); ?>"><?php echo e($prev->title); ?></a></p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="next">
                            <p class="pte" style="text-align: right;">下一篇</p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($next): ?>
                                <div class="relevant-news clearfix">
                                
                                    <p class="title-hover" style="text-align: right;    width: 300px;margin: 0"><a href="<?php echo e(url('news/'.$next->id)); ?>"><?php echo e($next->title); ?></a></p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>



            </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/shop-xenical/shop-xenical-v1/resources/views/web/news/show.blade.php ENDPATH**/ ?>