<div class="appointment-single-item">
    <div class="thumb"
            <?php echo render_background_image_markup_by_attachment_id($appointment->image,'','grid'); ?>

    >
        <?php if(!empty($appointment->category)): ?>
        <div class="cat">
            <a href="<?php echo e(route('frontend.appointment.category',['id' => $appointment->category->id,'any' => Str::slug(optional(optional($appointment->category)->lang_front)->title ?? __("Uncategorized"))])); ?>"><?php echo e(optional(optional($appointment->category)->lang_front)->title ?? __("Uncategorized")); ?></a>
        </div>
        <?php endif; ?>
    </div>
    <div class="content">
        <?php if(!empty(optional($appointment->lang_front)->designation)): ?>
            <span class="designation"><?php echo e(optional($appointment->lang_front)->designation ?? ''); ?></span>
        <?php endif; ?>
        <?php if(count($appointment->reviews) > 0): ?>
            <div class="rating-wrap">
                <div class="ratings">
                    <span class="hide-rating"></span>
                    <span class="show-rating" style="width: <?php echo e(get_appointment_ratings_avg_by_id($appointment->id) / 5 * 100); ?>%"></span>
                </div>
                <p><span class="total-ratings">(<?php echo e(count($appointment->reviews)); ?>)</span></p>
            </div>
        <?php endif; ?>
        <a href="<?php echo e(route('frontend.appointment.single',[optional($appointment->lang_front)->slug ?? __('untitled'),$appointment->id])); ?>"><h4 class="title"><?php echo e(optional($appointment->lang_front)->title ?? ''); ?></h4></a>
        <?php if(!empty(optional($appointment->lang_front)->location)): ?>
            <span class="location"><i class="fas fa-map-marker-alt"></i><?php echo e(optional($appointment->lang_front)->location ?? ''); ?></span>
        <?php endif; ?>

        <p><?php echo e(Str::words(strip_tags(optional($appointment->lang_front)->short_description ?? ''),10)); ?></p>
        <div class="btn-wrapper">
            <a href="<?php echo e(route('frontend.appointment.single',[optional($appointment->lang_front)->slug ?? __('untitled'),$appointment->id])); ?>" class="boxed-btn"><?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_booking_button_text')); ?></a>
        </div>
    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/appointment/grid.blade.php ENDPATH**/ ?>