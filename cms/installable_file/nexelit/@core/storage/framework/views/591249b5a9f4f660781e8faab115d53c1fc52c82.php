<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Attendance Confirm')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-confirm-area">
                        <h4 class="title"><?php echo e(__('Attendance Confirm')); ?></h4>
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
                        <form action="<?php echo e(route('frontend.event.payment.confirm')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php
                            $custom_fields = unserialize( $attendance_details->custom_fields,['class' => false]);
                            $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';
                            $name = auth()->check() ? auth()->user()->name : '';
                            $email = auth()->check() ? auth()->user()->email :'';
                            ?>
                            <input type="hidden" name="attendance_id" value="<?php echo e($attendance_details->id); ?>">
                            <input type="hidden" name="payment_gateway" value="<?php echo e($payment_gateway); ?>">
                             <input type="hidden" name="captcha_token" id="gcaptcha_token">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td><?php echo e(__('Your Name')); ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="name" value="<?php echo e($name); ?>" class="form-control" placeholder="<?php echo e(__('Enter Your Name')); ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Your Email')); ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="email" name="email" value="<?php echo e($email); ?>" class="form-control" placeholder="<?php echo e(__('Enter Your Email')); ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Event Name')); ?></td>
                                    <td><?php echo e($attendance_details->event_name); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Event Cost')); ?></td>
                                    <td>
                                        <strong><?php echo e(amount_with_currency_symbol($attendance_details->event_cost * $attendance_details->quantity)); ?></strong>
                                        <?php if(!check_currency_support_by_payment_gateway($payment_gateway)): ?>
                                            <br>
                                            <small><?php echo e(__('You will charge in')); ?> <?php echo e(get_charge_currency($payment_gateway)); ?> <?php echo e(__('you have to pay')); ?> <strong><?php echo e(get_charge_amount($attendance_details->event_cost * $attendance_details->quantity,$payment_gateway).get_charge_currency($payment_gateway)); ?></strong></small>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Quantity')); ?></td>
                                    <td><?php echo e($attendance_details->quantity); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Payment Gateway')); ?></td>
                                    <td class="text-capitalize">
                                        <?php if($payment_gateway == 'manual_payment'): ?>
                                            <?php echo e(get_static_option('site_manual_payment_name')); ?>

                                        <?php else: ?>
                                            <?php echo e($payment_gateway); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if($payment_gateway == 'manual_payment'): ?>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                                    <div class="label mb-2"><?php echo e(__('Attach your bank Document')); ?></div>
                                                    <input class="form-control btn btn-primary btn-sm pb-2" type="file" name="manual_payment_attachment">
                                                    <span class="help-info mt-2"><?php echo get_manual_payment_description(); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="btn-wrapper">
                            <button type="submit" class="submit-btn style-01"><?php echo e(__('Pay Now')); ?></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php if(!empty(get_static_option('site_google_captcha_v3_site_key')) && !empty(get_static_option('site_google_captcha_status'))): ?>
        <script
            src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function (token) {
                    document.getElementById('gcaptcha_token').value = token;
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/payment/booking-confirm.blade.php ENDPATH**/ ?>