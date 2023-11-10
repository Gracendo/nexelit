<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Enroll')); ?> : <?php echo e($course->lang_front->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Enroll')); ?> : <?php echo e($course->lang_front->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="enroll-area-wrapper">
                        <?php if(auth()->guard('web')->check()): ?>
                            <div class="enroll-form-wrapper">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <h4 class="amount-title"><?php echo e(__('Payable Amount')); ?> <span class="price"><?php echo e(amount_with_currency_symbol($course->price)); ?></span></h4>
                                <form action="<?php echo e(route('frontend.course.enroll.submit')); ?>" method="post" class="appointment-booking-form" id="appointment_rating_form" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('Name')); ?></label>
                                        <input type="text" name="name" class="form-control" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e(auth()->guard('web')->user()->name); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><?php echo e(__('Email')); ?></label>
                                        <input type="email" name="email" class="form-control" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(auth()->guard('web')->user()->email); ?>">
                                    </div>
                                    <div class="form-group coupon">
                                        <label for="coupon"><?php echo e(__('Have Coupon?')); ?></label>
                                        <input type="text" name="coupon" class="form-control" placeholder="<?php echo e(__('Coupon')); ?>" >
                                        <span class="right spin-none" id="course_coupon_apply"><?php echo e(__('Apply')); ?><i class="fas fa-spinner fa-spin"></i></span>
                                    </div>
                                    <div class="coupon-msg-wrap"></div>
                                    <?php if(!empty($course->price) && $course->price != 0): ?>
                                        <?php echo render_payment_gateway_for_form(false); ?>

                                        <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                            <div class="form-group manual_payment_transaction_field <?php if( get_static_option('site_default_payment_gateway') === 'manual_payment'): ?> d-block <?php endif; ?> ">
                                                <div class="label mb-2"><?php echo e(__('Attach your bank Document')); ?></div>
                                                <input class="form-control btn btn-primary btn-sm pb-2 pt-2" type="file" name="manual_payment_attachment">
                                                <span class="help-info mt-2"><?php echo get_manual_payment_description(); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                   <div class="btn-wrapper">
                                       <button type="submit" class="btn-boxed enroll" ><?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_enroll_button_text')); ?></button>
                                   </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <?php echo $__env->make('frontend.partials.ajax-login-form',['title' => __('Login to enroll')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('frontend.partials.ajax-login-form-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        (function (){
            "use strict";

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                var manual_gateway_tr = $('.manual_payment_transaction_field');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway === 'manual_payment'){
                    manual_gateway_tr.removeClass('d-none').addClass('d-block');
                }else{
                    manual_gateway_tr.addClass('d-none').removeClass('d-block');
                }
            });

            $(document).on('click','#course_coupon_apply',function (){
               var course_id = $('input[name="course_id"]').val();
               var coupon = $('input[name="coupon"]').val();
                $(this).removeClass('spin-none')
               if(coupon == ''){
                    $('.coupon-msg-wrap').html('');
                    $('.coupon-msg-wrap').html('<span class="text-danger">'+'<?php echo e(__("enter coupon")); ?>'+'</span>');
                    $(this).addClass('spin-none');
                   return
                }
               $.ajax({
                   'type' : 'post',
                   'url' : "<?php echo e(route('frontend.course.apply.coupon')); ?>",
                   data: {
                        '_token': "<?php echo e(csrf_token()); ?>",
                        'course_id' : course_id,
                        'coupon' : coupon
                   },
                   success: function (data){
                       $('#course_coupon_apply').addClass('spin-none');
                       $('.coupon-msg-wrap').html('');
                       $('.coupon-msg-wrap').html('<span class="text-'+data.status+'">'+data.msg+'</span>');
                       if(data.status == 'success'){
                           var oldPrice = $('.enroll-form-wrapper .amount-title .price').text();
                           $('.enroll-form-wrapper .amount-title .price').html(data.amount+'<del>'+oldPrice+'</del>');
                       }

                   }
               });
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/courses/enroll.blade.php ENDPATH**/ ?>