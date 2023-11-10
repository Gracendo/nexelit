<div class="course-single-grid-item">
    <div class="thumb">
        <a href="<?php echo e(route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])); ?>">
            <?php echo render_image_markup_by_attachment_id($course->image); ?>

        </a>
        <div class="price-wrap">
            <?php echo e(amount_with_currency_symbol($course->price)); ?>

            <del><?php echo e(amount_with_currency_symbol($course->sale_price)); ?></del>
        </div>
        <div class="cat">
            <a class="bg-<?php echo e($increment ?? ''); ?>" href="<?php echo e(route('frontend.course.category',[Str::slug(optional(optional($course->category)->lang_front)->title,'-',optional(optional($course->category)->lang_front)->lang),optional($course->category)->id])); ?>"><?php echo e(optional(optional($course->category)->lang_front)->title); ?></a>
        </div>
    </div>
    <div class="content">
        <?php if(count($course->reviews) > 0): ?>
            <div class="rating-wrap">
                <div class="ratings">
                    <span class="hide-rating"></span>
                    <span class="show-rating" style="width: <?php echo e(get_course_ratings_avg_by_id($course->id) / 5 * 100); ?>%"></span>
                </div>
                <p><span class="total-ratings">(<?php echo e(count($course->reviews)); ?>)</span></p>
            </div>
        <?php endif; ?>
        <h3 class="title"><a href="<?php echo e(route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])); ?>"><?php echo e(Str::words(optional($course->lang_front)->title,6,'..')); ?></a></h3>
        <?php if(!empty(optional($course->instructor)->id)): ?>
        <div class="instructor-wrap"><span><?php echo e(__('By')); ?></span> <a href="<?php echo e(route('frontend.course.instructor',[Str::slug(optional($course->instructor)->name),optional($course->instructor)->id])); ?>"><?php echo e(optional($course->instructor)->name); ?></a></div>
        <?php endif; ?>
        <div class="description">
            <?php echo Str::words(strip_tags(optional($course->lang_front)->description),15); ?>

        </div>
        <div class="footer-part">
            <span><i class="fas fa-users"></i> <?php echo e($course->enrolled_student); ?> <?php echo e(__('Enrolled')); ?></span>
            <span><i class="fas fa-clock"></i> <?php echo e($course->duration); ?> <?php echo e($course->duration_type); ?></span>
        </div>
    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/course/grid.blade.php ENDPATH**/ ?>