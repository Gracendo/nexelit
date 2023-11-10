<div class="single-case-studies-item">
    <div class="thumb">
        <?php echo render_image_markup_by_attachment_id($work->image); ?>

    </div>
    <div class="cart-icon">
        <h4 class="title"><a href="<?php echo e(route('frontend.work.single',$work->slug)); ?>"> <?php echo e($work->title); ?></a></h4>
    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/work/grid.blade.php ENDPATH**/ ?>