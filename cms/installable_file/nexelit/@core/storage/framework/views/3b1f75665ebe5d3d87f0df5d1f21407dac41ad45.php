<?php if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_'.$user_select_lang_slug.'_id')))): ?>
    <?php
        $popup_id = get_static_option('popup_selected_'.$user_select_lang_slug.'_id');

        $popup_details = \App\PopupBuilder::find($popup_id);
        $website_url = url('/');
        if (preg_match('/(xgenious)/',$website_url)){
            $popup_details = \App\PopupBuilder::where('lang',$user_select_lang_slug)->inRandomOrder()->first();
        }
        if(!empty($popup_details)){
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
        }
    ?>
    <script src="<?php echo e(asset('assets/common/js/countdown.jquery.js')); ?>"></script>
    <?php echo $__env->make('frontend.partials.popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /Users/sharifurrahman/Desktop/sharifur-backup/localhost/nexelit/@core/resources/views/frontend/partials/popup-structure.blade.php ENDPATH**/ ?>