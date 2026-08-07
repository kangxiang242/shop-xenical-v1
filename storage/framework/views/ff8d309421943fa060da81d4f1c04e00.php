<script>
    var new_message_time = localStorage.getItem("new_message_time")?localStorage.getItem("new_message_time"):0;
    var current_time = Date.parse(new Date())/1000;
    if(current_time - new_message_time >= 600) {
        localStorage.setItem("new_message_time", current_time)
    }

    var end_conversation_time = parseInt("<?php echo e(app('cache.config')->get('end_conversation_time',0)); ?>")
    var end_conversation_text = "<?php echo e(app('cache.config')->get('end_conversation_text')); ?>";


</script>
<div class="customer-service ">
    <div class="entrance">
        <i class="iconfont" id="customer-icon">&#xe637;</i>
    </div>
    <div class="chat-window close-chat-main">
        <div class="with">
            <div class="avatar-wrap">
                <img id="kf-avatar" src="<?php echo e(asset_upload(app('cache.config')->get('manual_customer_avatar'))); ?>" alt="人工客服">
            </div>
            <div class="user">
                <p class="nickname"><?php echo e(app('cache.config')->get('manual_customer_nickname')); ?></p>
                <p class="status">
                    <span class="dots on"></span>
                    <span class="text">Online</span>
                </p>
            </div>
            <a class="close-chat" href="javascript:;"></a>
        </div>
        <div class="chat-main" id="message-content">
            <div class="time"><?php echo e(date('Hi')<='1200'?"上午":"下午"); ?><?php echo e(ltrim(date('h:i'),'0')); ?></div>
            <div class="message reply lead">
                <div class="list clearfix">
                    <span class="re-avatar"><img src="<?php echo e(asset_upload(app('cache.config')->get('manual_customer_avatar'))); ?>"></span>
                    <div class="content">
                        <div class="leading">
                            <p class="welcome"><?php echo str_replace(PHP_EOL,"<br>",app('cache.config')->get('leading_welcome')); ?> </p>

                            <ul class="words">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leading_words; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $words): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="javascript:send_message('<?php echo e(array_get($words,'keyword')); ?>');"><?php echo e(array_get($words,'keyword')); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            



        </div>
        <div class="send">
            <div class="message">
                <form onsubmit="return send_message()">
                    <input id="customer-content" name="search" placeholder="請問有什麼可以幫到您？" />
                </form>
            </div>
            <div class="over" id="send-message"><i class="iconfont">&#xe604;</i></div>
        </div>
    </div>
</div>
<?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/shop-xenical/shop-xenical-v1/resources/views/components/customer-service.blade.php ENDPATH**/ ?>