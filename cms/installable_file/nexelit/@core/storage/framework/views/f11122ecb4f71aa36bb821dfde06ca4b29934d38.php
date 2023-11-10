<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url"  content="<?php echo e(route('frontend.donations.single',$donation->slug)); ?>" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="<?php echo e($donation->title); ?>" />
    <?php echo render_og_meta_image_by_attachment_id($donation->image); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($donation->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($donation->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($donation->meta_tags); ?>">
    <meta name="tags" content="<?php echo e($donation->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contribute-single-item">
                        <div class="thumb">
                            <?php echo render_image_markup_by_attachment_id($donation->image,'','large'); ?>

                            <div class="thumb-content">
                                <div class="progress-item">
                                    <div class="single-progressbar">
                                        <div class="donation-progress" data-percent="<?php echo e(get_percentage($donation->amount,$donation->raised)); ?>"></div>
                                    </div>
                                </div>
                                <div class="goal">
                                    <h4 class="raised"><?php echo e(get_static_option('donation_raised_'.$user_select_lang_slug.'_text')); ?> <?php echo e(amount_with_currency_symbol($donation->raised ? $donation->raised : 0 )); ?></h4>
                                    <h4 class="raised"><?php echo e(get_static_option('donation_goal_'.$user_select_lang_slug.'_text')); ?> <?php echo e(amount_with_currency_symbol($donation->amount)); ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="donation-goal">

                            </div>
                            <div class="details-content-area">
                                <?php echo $donation->donation_content; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="donation_wrapper">
                            <h3 class="title"><?php echo e(get_static_option('donation_single_'.$user_select_lang_slug.'_form_title')); ?></h3>
                            <div class="single_amount_wrapper">
                                <?php
                                    $custom_amounts  =  get_static_option('donation_custom_amount');
                                    $custom_amounts = !empty($custom_amounts) ? explode(',',$custom_amounts) : [50,100,150,200];
                                ?>
                                <?php $__currentLoopData = $custom_amounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single_amount" data-value="<?php echo e(trim($amount)); ?>"><?php echo e(amount_with_currency_symbol($amount)); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php if($errors->any()): ?>
                                <ul class="alert alert-danger">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                            <form action="<?php echo e(route('frontend.donations.log.store')); ?>" method="post" enctype="multipart/form-data" class="donation-form-wrapper">
                                <?php echo csrf_field(); ?>
                                 <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <div class="amount_wrapper">
                                    <div class="suffix"><?php echo e(site_currency_symbol()); ?></div>
                                    <input type="hidden" name="donation_id" value="<?php echo e($donation->id); ?>" >
                                    <input type="number" name="amount" value="<?php echo e(trim(get_static_option('donation_default_amount'))); ?>" step="1" min="1">
                                </div>
                                <div class="form-group">
                                    <div class="label"><?php echo e(__('Name')); ?></div>
                                    <input type="text" name="name" placeholder="<?php echo e(__('Name')); ?>" <?php if(auth()->guard('web')->check()): ?> value="<?php echo e(auth()->guard('web')->user()->name); ?>"  <?php endif; ?> class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="label"><?php echo e(__('Email')); ?></div>
                                    <input type="email" name="email" placeholder="<?php echo e(__('Email')); ?>" <?php if(auth()->guard('web')->check()): ?> value="<?php echo e(auth()->guard('web')->user()->email); ?>" <?php endif; ?> class="form-control">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="anonymous" class="form-check-input" id="anonymous">
                                    <label class="form-check-label" for="anonymous"><?php echo e(__('Donate Anonymously')); ?></label>
                                </div>
                                <?php echo render_payment_gateway_for_form(); ?>

                                <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                    <div class="form-group manual_payment_transaction_field" <?php if( get_static_option('site_default_payment_gateway') === 'manual_payment'): ?> style="display: block;"<?php endif; ?>>
                                        <div class="label mb-2"><?php echo e(__('Attach your bank Document')); ?></div>
                                        <input class="form-control btn btn-primary btn-sm pb-5 mb-3" type="file" name="manual_payment_attachment"><br>
                                        <span class="help-info mt-3"><?php echo get_manual_payment_description(); ?></span>
                                    </div>
                                <?php endif; ?>

                                <button class="donation-btn btn-boxed style-01" type="submit"><?php echo e(get_static_option('donation_single_'.$user_select_lang_slug.'_form_button_text')); ?></button>
                            </form>
                        </div>
                        <div class="all-donor-list">
                            <h4 class="title"><?php echo e(get_static_option('donation_single_'.$user_select_lang_slug.'_recent_donation_text')); ?></h4>
                            <?php if(count($all_donations) > 0): ?>
                            <ul>
                                <?php $__currentLoopData = $all_donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="single-donor">
                                    <div class="icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="dtitle">
                                            <?php if($data->anonymous == 1): ?>
                                                <?php echo e(__('anonymous')); ?>

                                             <?php else: ?>
                                            <?php echo e($data->name); ?>

                                            <?php endif; ?>
                                        </h4>
                                        <div class="bottom-part">
                                            <div class="amount"><?php echo e(amount_with_currency_symbol($data->amount)); ?></div>
                                            <div class="time"><?php echo e(date_format($data->created_at,'d M y h:i:s')); ?></div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php else: ?>
                                <span class="alert alert-warning"><?php echo e(__('no donation found')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>
    <script>
        (function($) {
            'use strict';
            var allProgress =  $('.donation-progress');
            $.each(allProgress,function (index, value) {
                $(this).rProgressbar({
                    percentage: $(this).data('percent'),
                    fillBackgroundColor: "<?php echo e(get_static_option('site_color')); ?>"
                });
            })
            /*------------------------------
                donate activation
            -------------------------------*/

            $(document).on('click', '.donation_wrapper .single_amount', function(e) {
                e.preventDefault();
                $('input[name="amount"]').val($(this).data('value'));
            });

            var defaulGateway = $('#site_global_payment_gateway').val();
            $('.payment-gateway-wrapper ul li[data-gateway="'+defaulGateway+'"]').addClass('selected');

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                if(gateway == 'manual_payment'){
                    $('.manual_payment_transaction_field').show();
                }else{
                    $('.manual_payment_transaction_field').hide();
                }
                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val(gateway);
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/donations/donation-single.blade.php ENDPATH**/ ?>