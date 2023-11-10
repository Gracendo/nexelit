<section class="dynamic-page-content-area padding-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dynamic-page-content-wrap">
                    <?php if($page_post->visibility === 'user' && !auth()->guard('web')->check()): ?>
                        <p><strong><a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('login')); ?></a></strong> <?php echo e(__('to see page content')); ?></p>
                    <?php else: ?>
                        <?php echo $page_post->content; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/partials/dynamic-page-content.blade.php ENDPATH**/ ?>