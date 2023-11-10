<div class="single-knowledgebase-list-item <?php echo e($class ?? ''); ?>">
    <h4 class="title"><a href="<?php echo e(route('frontend.knowledgebase.single',$donation->slug)); ?>"><i
                    class="fas fa-folder"></i> <?php echo e($donation->title); ?></a></h4>
    <div class="short-content">
        <?php echo Str::words(strip_tags($donation->content),50); ?>

    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/donation/grid.blade.php ENDPATH**/ ?>