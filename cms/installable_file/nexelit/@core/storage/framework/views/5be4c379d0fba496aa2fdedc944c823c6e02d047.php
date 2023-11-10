<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Payment Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php echo $__env->make('backend.partials.media-upload.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
    <style>
        .accordion-wrapper .card .card-header button {
            color: #000 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Payment Gateway Settings")); ?></h4>
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
                        <form action="<?php echo e(route('admin.general.payment.settings')); ?>" method="POST"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="site_global_currency"><?php echo e(__('Site Global Currency')); ?></label>
                                        <select name="site_global_currency" class="form-control"
                                                id="site_global_currency">
                                            <?php $__currentLoopData = \Xgenious\Paymentgateway\Facades\XgPaymentGateway::script_currency_list(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur => $symbol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cur); ?>"
                                                        <?php if(get_static_option('site_global_currency') == $cur): ?> selected <?php endif; ?>><?php echo e($cur.' ( '.$symbol.' )'); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_currency_symbol_position"><?php echo e(__('Currency Symbol Position')); ?></label>
                                        <?php $all_currency_position = ['left','right']; ?>
                                        <select name="site_currency_symbol_position" class="form-control"
                                                id="site_currency_symbol_position">
                                            <?php $__currentLoopData = $all_currency_position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cur); ?>"
                                                        <?php if(get_static_option('site_currency_symbol_position') == $cur): ?> selected <?php endif; ?>><?php echo e(ucwords($cur)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_default_payment_gateway"><?php echo e(__('Default Payment Gateway')); ?></label>
                                        <select name="site_default_payment_gateway" class="form-control" >
                                            <?php
                                                $all_gateways = ['paypal','manual_payment','mollie','paytm','stripe','razorpay','flutterwave','paystack','payfast','cashfree','instamojo','marcadopago','square','cinetpay','paytabs'];
                                            ?>
                                            <?php $__currentLoopData = $all_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <option value="<?php echo e($gateway); ?>" <?php if(get_static_option('site_default_payment_gateway') == $gateway): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_',' ',$gateway))); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $global_currency = get_static_option('site_global_currency');?>

                                    <?php if($global_currency != 'USD'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate"><?php echo e(__($global_currency.' to USD Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_usd_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(sprintf(__('enter %1$s to USD exchange rate. eg: 1 %2$s = ? USD'),$global_currency,$global_currency)); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'IDR'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate"><?php echo e(__($global_currency.' to IDR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_idr_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(sprintf(__('enter %1$s to USD exchange rate. eg: 1 %2$s = ? IDR'),$global_currency,$global_currency)); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'INR' && !empty(get_static_option('paytm_gateway') || !empty(get_static_option('razorpay_gateway')))): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate"><?php echo e(__($global_currency.' to INR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_inr_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to INR exchange rate. eg: 1'.$global_currency.' = ? INR')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'NGN' && !empty(get_static_option('paystack_gateway') )): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate"><?php echo e(__($global_currency.' to NGN Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_ngn_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to NGN exchange rate. eg: 1'.$global_currency.' = ? NGN')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'ZAR'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate"><?php echo e(__($global_currency.' to ZAR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_zar_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(sprintf(__('enter %1$s to USD exchange rate. eg: 1 %2$s = ? ZAR'),$global_currency,$global_currency)); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'BRL'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate"><?php echo e(__($global_currency.' to BRL Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_brl_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to BRL exchange rate. eg: 1'.$global_currency.' = ? BRL')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'MYR'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_myr_exchange_rate"><?php echo e(__($global_currency.' to MYR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_myr_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_myr_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to BRL exchange rate. eg: 1'.$global_currency.' = ? MYR')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php echo $__env->make('backend.general-settings.payment-gateway.credentials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                </div>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function ($) {

            $(document).on('change','#site_global_currency',function (e) {
                e.preventDefault();
                checkCurrency();
            });

            function checkCurrency() {
                var selectedValue = $('#site_global_currency').val();
                if(selectedValue == 'USD'){
                    $('#site_usd_to_nri_exchange_rate').parent().show();
                }else{
                    $('#site_usd_to_nri_exchange_rate').parent().hide();
                }
            }
            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/payment-gateway/basic.blade.php ENDPATH**/ ?>