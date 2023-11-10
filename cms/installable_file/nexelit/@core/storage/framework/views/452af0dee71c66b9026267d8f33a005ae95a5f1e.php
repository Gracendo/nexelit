<?php
    if(empty($popup_details)) {return;}
        $popup_class = '';
        if ($popup_details->type == 'notice'){
            $popup_class = 'notice-modal';
        }elseif($popup_details->type == 'only_image'){
            $popup_class = 'only-image-modal';
        }elseif($popup_details->type == 'promotion'){
            $popup_class = 'promotion-modal';
        }else{
            $popup_class = 'discount-modal';
        }
?>
<div class="nx-popup-backdrop"></div>
<div class="nx-popup-wrapper <?php echo e($popup_class); ?>">
    <div class="nx-modal-content-wrapper">
        <?php if($popup_details->type == 'notice'): ?>
            <div class="nx-modal-inner-content-wrapper">
                <div class="nx-popup-close">×</div>
                <div class="nx-modal-content">
                    <div class="notice-modal-content-wrapper">
                        <div class="right-side-content">
                            <h4 class="title"><?php echo e($popup_details->title); ?></h4>
                            <p><?php echo e($popup_details->description); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($popup_details->type == 'only_image'): ?>
            <div class="nx-modal-inner-content-wrapper"
                 <?php echo render_background_image_markup_by_attachment_id($popup_details->only_image); ?>

            >
                <div class="nx-popup-close">×</div>
                <div class="nx-modal-content"></div>
            </div>
        <?php elseif($popup_details->type == 'promotion'): ?>
            <div class="nx-modal-inner-content-wrapper"
                <?php echo render_background_image_markup_by_attachment_id($popup_details->background_image); ?>

            >
                <div class="nx-popup-close">×</div>
                <div class="nx-modal-content">
                    <div class="promotional-modal-content-wrapper">
                        <div class="left-content-warp">
                            <?php echo render_image_markup_by_attachment_id($popup_details->only_image); ?>

                        </div>
                        <div class="right-content-warp">
                            <div class="right-content-inner-wrap">
                                <h4 class="title"><?php echo e($popup_details->title); ?></h4>
                                <p><?php echo e($popup_details->description); ?></p>
                                <?php if(!empty($popup_details->btn_status)): ?>
                                <div class="btn-wrapper">
                                    <a href="<?php echo e($popup_details->button_link); ?>" rel="canonical" class="btn-boxed"><?php echo e($popup_details->button_text); ?></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="nx-modal-inner-content-wrapper"
                <?php echo render_background_image_markup_by_attachment_id($popup_details->background_image); ?>

            >
                <div class="nx-popup-close">×</div>
                <div class="nx-modal-content">
                    <div class="discount-modal-content-wrapper">
                        <div class="left-content-warp">
                            <?php echo render_image_markup_by_attachment_id($popup_details->only_image); ?>

                        </div>
                        <div class="right-content-warp">
                            <div class="right-content-inner-wrap">
                                <h4 class="title"><?php echo e($popup_details->title); ?></h4>
                                <p><?php echo e($popup_details->description); ?></p>
                                <div class="countdown-wrapper">
                                    <div id="countdown"></div>
                                </div>
                                <?php if(!empty($popup_details->btn_status)): ?>
                                    <div class="btn-wrapper">
                                        <a rel="canonical"  href="<?php echo e($popup_details->button_link); ?>" class="btn-boxed"><?php echo e($popup_details->button_text); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/partials/popup.blade.php ENDPATH**/ ?>