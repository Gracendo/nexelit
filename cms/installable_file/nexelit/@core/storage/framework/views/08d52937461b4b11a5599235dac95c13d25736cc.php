<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order For')); ?> <?php echo e(' : '.$order_details->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="order-service-page-content-area padding-100">
        <div class="container">
            <div class="row reorder-xs justify-content-between ">
                <div class="col-lg-6">
                    <div class="order-content-area">
                        <h3 class="order-title"><?php echo e(get_static_option('order_page_'.$user_select_lang_slug.'_form_title')); ?></h3>
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
                       <div class="order-tab-wrap">
                           <nav>
                               <div class="nav nav-tabs" role="tablist">
                                   <?php if(!auth()->check()): ?>
                                   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"  aria-selected="true"><i class="fas fa-user"></i></a>
                                   <?php endif; ?>
                                   <a class="nav-item nav-link  <?php if(auth()->check()): ?> active <?php else: ?> disabled <?php endif; ?>" disabled id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-address-book"></i></a>
                               </div>
                           </nav>
                           <div class="tab-content" >
                               <?php if(!auth()->check()): ?>
                               <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                   <?php if(get_static_option('disable_guest_mode_for_package_module')): ?>
                                   <div class="checkout-type margin-bottom-30  <?php if(auth()->check()): ?> d-none  <?php endif; ?>">
                                       <div class="custom-control custom-switch">
                                           <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                           <label class="custom-control-label" for="guest_logout"><?php echo e(__('Guest Order')); ?></label>
                                       </div>
                                   </div>
                                   <?php endif; ?>
                                   <?php if(!auth()->check()): ?>
                                       <div class="login-form">
                                           <form action="<?php echo e(route('user.login')); ?>" method="post" enctype="multipart/form-data" class="account-form" id="login_form_order_page">
                                               <?php echo csrf_field(); ?>
                                               <div class="error-wrap"></div>
                                               <div class="form-group">
                                                   <input type="text" name="username" class="form-control" placeholder="<?php echo e(__('Username')); ?>">
                                               </div>
                                               <div class="form-group">
                                                   <input type="password" name="password" class="form-control" placeholder="<?php echo e(__('Password')); ?>">
                                               </div>
                                               <div class="form-group btn-wrapper">
                                                   <button type="submit" id="login_btn" class="submit-btn"><?php echo e(__('Login')); ?></button>
                                               </div>
                                               <div class="row mb-4 rmber-area">
                                                   <div class="col-6">
                                                       <div class="custom-control custom-checkbox mr-sm-2">
                                                           <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                                           <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                                       </div>
                                                   </div>
                                                   <div class="col-6 text-right">
                                                       <a class="d-block" href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Create new account?')); ?></a>
                                                       <a href="<?php echo e(route('user.forget.password')); ?>"><?php echo e(__('Forgot Password?')); ?></a>
                                                   </div>
                                               </div>
                                           </form>
                                       </div>
                                   <?php else: ?>
                                       <div class="alert alert-success">
                                            <?php echo e(__('Your Are Logged In As ')); ?> <?php echo e(auth()->user()->name); ?>

                                       </div>
                                   <?php endif; ?>
                                   <?php if(!auth()->check()): ?>
                                   <div class="next-step">
                                       <button class="next-step-btn btn-boxed d-none" type="button"><?php echo e(__('Next Step')); ?></button>
                                   </div>
                                   <?php endif; ?>
                               </div>
                               <?php endif; ?>
                               <div class="tab-pane fade <?php if(auth()->check()): ?> show active <?php endif; ?>" id="nav-profile" role="tabpanel">
                                   <form action="<?php echo e(route('frontend.order.message')); ?>" method="post" enctype="multipart/form-data" class="contact-form order-form">
                                       <?php echo csrf_field(); ?>
                                       <input type="hidden" name="package" value="<?php echo e($order_details->id); ?>">
                                       <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                       <div class="row">
                                           <div class="col-lg-12">
                                               <?php echo render_form_field_for_frontend(get_static_option('order_page_form_fields')); ?>

                                                <?php echo render_payment_gateway_for_form(); ?>


                                           </div>
                                           <div class="col-lg-12">
                                               <button class="submit-btn width-200" type="submit"><?php echo e(__('Order Package')); ?></button>
                                           </div>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content-area">
                        <div class="single-price-plan-01 style-02 active">
                            <div class="price-header">
                                <div class="name-box">
                                    <h4 class="name"><?php echo e($order_details->title); ?></h4>
                                </div>
                                <div class="price-wrap">
                                    <span class="price"><?php echo e(amount_with_currency_symbol($order_details->price)); ?></span><span class="month"><?php echo e($order_details->type); ?></span>
                                </div>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <?php
                                        $features = explode("\n",$order_details->features);
                                    ?>
                                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($item); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="btn-wrapper text-center">
                                <?php if(!empty($order_details->url_status)): ?>
                                    <a class="order-btn boxed-btn" href="<?php echo e(route('frontend.plan.order',$order_details->id)); ?>"><?php echo e($order_details->btn_text); ?></a>
                                <?php else: ?>
                                    <a class="order-btn boxed-btn" href="<?php echo e($order_details->btn_url); ?>"><?php echo e($order_details->btn_text); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script>
        $(document).ready(function ($) {

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                var manual_gateway_tr = $('.manual_payment_transaction_field');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway === 'manual_payment'){
                    manual_gateway_tr.show();
                }else{
                    manual_gateway_tr.hide();
                }
            });

            $(document).on('click', '#login_btn', function (e) {
                e.preventDefault();
                var formContainer = $('#login_form_order_page');
                var el = $(this);
                var username = formContainer.find('input[name="username"]').val();
                var password = formContainer.find('input[name="password"]').val();
                var remember = formContainer.find('input[name="remember"]').val();

                el.text('<?php echo e(__("Please Wait")); ?>');

                $.ajax({
                    type: 'post',
                    url: "<?php echo e(route('user.ajax.login')); ?>",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        username : username,
                        password : password,
                        remember : remember,
                    },
                    success: function (data){
                        if(data.status == 'invalid'){
                            el.text('<?php echo e(__("Login")); ?>')
                            formContainer.find('.error-wrap').html('<div class="alert alert-danger">'+data.msg+'</div>');
                        }else{
                            formContainer.find('.error-wrap').html('');
                            el.text('<?php echo e(__("Login Success.. Redirecting ..")); ?>');
                            location.reload();
                        }
                    },
                    error: function (data){
                        var response = data.responseJSON.errors
                        formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                        $.each(response,function (value,index){
                            formContainer.find('.error-wrap ul').append('<li>'+value+'</li>');
                        });
                        el.text('<?php echo e(__("Login")); ?>');
                    }
                });
            });
        
            
            var defaulGateway = $('#site_global_payment_gateway').val();
            $('.payment-gateway-wrapper ul li[data-gateway="'+defaulGateway+'"]').addClass('selected');

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val($(this).data('gateway'));
            });

            $(document).on('change','#guest_logout',function (e) {
                e.preventDefault();
                var infoTab = $('#nav-profile-tab');
                var nextBtn = $('.next-step-btn');
                if($(this).is(':checked')){
                    $('.login-form').hide();
                    infoTab.attr('disabled',false).removeClass('disabled');
                    nextBtn.removeClass('d-none');
                }else{
                    $('.login-form').show();
                    infoTab.attr('disabled',true).addClass('disabled');
                    nextBtn.addClass('d-none');
                }
            });
            $(document).on('click','.next-step-btn',function(e){
                var infoTab = $('#nav-profile-tab');
                infoTab.attr('disabled',false).removeClass('disabled').addClass('active').siblings().removeClass('active');
                $('#nav-profile').addClass('show active').siblings().removeClass('show active');
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/package/order-page.blade.php ENDPATH**/ ?>