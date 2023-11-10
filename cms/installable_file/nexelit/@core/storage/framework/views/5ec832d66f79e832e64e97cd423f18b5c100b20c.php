<div class="single-events-list-item">
    <div class="thumb">
        <?php echo render_image_markup_by_attachment_id($event->image,'','grid'); ?>

    </div>
    <div class="content-area">
        <div class="top-part">
            <div class="time-wrap">
                <span class="date"><?php echo e(date('d',strtotime($event->date))); ?></span>
                <span class="month"><?php echo e(date('M',strtotime($event->date))); ?></span>
            </div>
            <div class="title-wrap">
                <a href="<?php echo e(route('frontend.events.single',$event->slug)); ?>"><h4 class="title"><?php echo e($event->title); ?></h4></a>
                <span class="location"><i class="fas fa-map-marker-alt"></i> <?php echo e($event->venue_location); ?></span>
            </div>
        </div>
        <p><?php echo e(strip_tags(Str::words(strip_tags($event->content),20))); ?></p>
    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/event/grid.blade.php ENDPATH**/ ?>