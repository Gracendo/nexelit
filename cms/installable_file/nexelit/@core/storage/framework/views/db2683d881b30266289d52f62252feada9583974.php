<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Booking')); ?> <?php echo e($event->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Booking')); ?> <?php echo e($event->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option($event->meta_tags)); ?>">
    <meta name="tags" content="<?php echo e(get_static_option($event->meta_description)); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="order-service-page-content-area padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="event-booking-form">
                        <h4><?php echo e(get_static_option('event_attendance_page_'.$user_select_lang_slug.'_title')); ?></h4>
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
                                        <?php if(get_static_option('disable_guest_mode_for_event_module')): ?>
                                        <div class="checkout-type margin-bottom-30 <?php if(auth()->check()): ?> d-none <?php endif; ?> ">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                                <label class="custom-control-label" for="guest_logout"><?php echo e(__('As A Guest')); ?></label>
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
                                                            <a class="d-block" href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Create an account?')); ?></a>
                                                            <a href="<?php echo e(route('user.forget.password')); ?>"><?php echo e(__('Forgot Password?')); ?></a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-success">
                                                <?php echo e(__('Your Are Logged In As')); ?> <?php echo e(auth()->user()->name); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(!auth()->check()): ?>
                                            <div class="next-step">
                                                <button class="next-step-btn btn-boxed" style="display: none" type="button"><?php echo e(__('Next Step')); ?></button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="tab-pane fade <?php if(auth()->check()): ?> show active <?php endif; ?>" id="nav-profile" role="tabpanel">
                                    <?php if(env('APP_ENV') == 'development' ): ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            You can build this form using admin panel <strong>Drag & Drop Form Builder</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                    <form method="post" action="<?php echo e(route('frontend.event.booking.store')); ?>" enctype="multipart/form-data">
                                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                        <input type="hidden" name="event_id" value="<?php echo e($event->id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo render_form_field_for_frontend(get_static_option('event_attendance_form_fields')); ?>

                                        <div class="form-group">
                                            <label for="quantity"><?php echo e(__('Quantity')); ?></label>
                                            <input type="number" min="1" max="<?php echo e($event->available_tickets); ?>" value="1" name="quantity" id="quantity">
                                        </div>
                                        <?php if(!empty($event->cost) && $event->cost > 0): ?>
                                            <?php echo render_payment_gateway_for_form(); ?>

                                        <?php endif; ?>
                                        <div class="btn-wrapper">
                                            <button type="submit" class="btn-boxed style-01"><?php echo e(get_static_option('event_attendance_page_'.$user_select_lang_slug.'_form_button_title')); ?></button>
                                        </div>
                                    </form>
                                </div>
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

            $(document).on('click', '#login_btn', function (e) {
                e.preventDefault();
                var formContainer = $('#login_form_order_page');
                var el = $(this);
                var username = formContainer.find('input[name="username"]').val();
                var password = formContainer.find('input[name="password"]').val();
                var remember = formContainer.find('input[name="remember"]').val();

                el.text('<?php echo e(__('Please Wait')); ?>');

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
                            el.text('Login')
                            formContainer.find('.error-wrap').html('<div class="alert alert-danger">'+data.msg+'</div>');
                        }else{
                            formContainer.find('.error-wrap').html('');
                            el.text('<?php echo e(__('Login Success.. Redirecting ..')); ?>');
                            location.reload();
                        }

                    },
                    error: function (data){
                        var response = data.responseJSON.errors
                        formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                        $.each(response,function (value,index){
                            formContainer.find('.error-wrap ul').append('<li>'+value+'</li>');
                        });
                        el.text('Login');
                    }
                });
            });

            var defaulGateway = $('#site_global_payment_gateway').val();
            $('.payment-gateway-wrapper ul li[data-gateway="'+defaulGateway+'"]').addClass('selected');

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('#site_global_payment_gateway').val(gateway);
                if(gateway == 'manual_payment'){
                    $('.manual_payment_transaction_field').addClass('show');
                }else{
                    $('.manual_payment_transaction_field').removeClass('show');
                }
                $('.payment-gateway-wrapper').find(('input')).val(gateway);
            });

            $(document).on('change','#guest_logout',function (e) {
                e.preventDefault();
                var infoTab = $('#nav-profile-tab');
                var nextBtn = $('.next-step-btn');
                if($(this).is(':checked')){
                    $('.login-form').hide();
                    infoTab.attr('disabled',false).removeClass('disabled');
                    nextBtn.show();
                }else{
                    $('.login-form').show();
                    infoTab.attr('disabled',true).addClass('disabled');
                    nextBtn.hide();
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

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/events/event-booking.blade.php ENDPATH**/ ?>