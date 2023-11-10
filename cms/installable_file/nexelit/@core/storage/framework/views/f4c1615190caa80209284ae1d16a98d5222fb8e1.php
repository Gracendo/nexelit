<?php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($item->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 ?>

<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url"  content="<?php echo e(route('frontend.appointment.single',[optional($item->lang_front)->slug ?? __('untitled'),$item->id])); ?>" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="<?php echo e(optional($item->lang_front)->title); ?>" />
    <meta property="og:image" content="<?php echo e($post_img); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(optional($item->lang_front)->meta_description); ?>">
    <meta name="tags" content="<?php echo e(optional($item->lang_front)->meta_tag); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(optional($item->lang_front)->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(optional($item->lang_front)->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appointment-details-item">
                       <div class="top-part">
                           <div class="thumb">
                               <?php echo render_image_markup_by_attachment_id($item->image,'full'); ?>

                           </div>
                           <div class="content">
                               <?php if(optional($item->lang_front)->designation): ?>
                               <span class="designation"><?php echo e(optional($item->lang_front)->designation); ?></span>
                               <?php endif; ?>
                               <h2 class="title"><?php echo e(optional($item->lang_front)->title); ?></h2>
                               <div class="short-description"><?php echo optional($item->lang_front)->short_description; ?></div>
                               <?php if(optional($item->lang_front)->location): ?>
                               <div class="location"><i class="fas fa-map-marked-alt"></i>  <?php echo e(optional($item->lang_front)->location); ?></div>
                               <?php endif; ?>
                               <div class="price-wrap">
                                   <h4 class="price"><?php echo e(__('Fee')); ?>: <span><?php echo e(amount_with_currency_symbol($item->price)); ?></span></h4>
                               </div>
                               <div class="social-share-wrap">
                                   <ul class="social-share">
                                       <?php echo single_post_share(route('frontend.appointment.single',[optional($item->lang_front)->slug ?? __('untitled'),$item->id]),optional($item->lang_front)->title,get_attachment_url_by_id($item->image,'full')); ?>

                                   </ul>
                               </div>
                           </div>
                       </div>
                        <div class="bottom-part">
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
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-link "  data-toggle="tab" href="#nav-information" role="tab"  aria-selected="false"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_information_tab_title')); ?></a>
                                    <a class="nav-link active"  data-toggle="tab" href="#nav-booking" role="tab"  aria-selected="true"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_booking_tab_title')); ?></a>
                                    <a class="nav-link"  data-toggle="tab" href="#nav-feedback" role="tab"  aria-selected="false"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_feedback_tab_title')); ?></a>
                                </div>
                            </nav>
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="nav-information" role="tabpanel" >
                                    <div class="information-area-wrap">
                                        <div class="description-wrap">
                                            <h3 class="title"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_about_me_title')); ?></h3>
                                            <?php echo optional($item->lang_front)->description; ?>

                                        </div>
                                        <?php if(!empty(current(optional($item->lang_front)->experience_info))): ?>
                                        <div class="education-info">
                                            <h3 class="title"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_educational_info_title')); ?></h3>
                                            <ul class="circle-list">
                                                <?php $__currentLoopData = optional($item->lang_front)->experience_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($info); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(!empty(current(optional($item->lang_front)->additional_info))): ?>
                                        <div class="additional-info">
                                            <h3 class="title"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_additional_info_title')); ?></h3>
                                            <ul class="circle-list">
                                                <?php $__currentLoopData = optional($item->lang_front)->additional_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($info); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(!empty(current(optional($item->lang_front)->specialized_info))): ?>
                                        <div class="specialised-info">
                                            <h3 class="title"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_specialize_info_title')); ?></h3>
                                            <ul class="circle-list">
                                                <?php $__currentLoopData = optional($item->lang_front)->specialized_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($info); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-booking" role="tabpanel" >
                                    <?php if($item->appointment_status === 'yes'): ?>
                                    <div class="booking-wrap">
                                        <div class="left-part">
                                            <div class="date-time-block">
                                                <h4 class="title"><?php echo e(__('Available On')); ?> <time><?php echo e(date('F Y')); ?></time></h4>
                                                <ul class="time-slot date">
                                                    <li data-date="<?php echo e(date('d-m-Y')); ?>"><?php echo e(date('d/m/Y')); ?></li>
                                                    <?php for($i=1; $i <10; $i++): ?>
                                                        <li data-date="<?php echo e(date('d-m-Y',strtotime("+".$i." day"))); ?>"><?php echo e(date('d/m/Y',strtotime("+".$i." day"))); ?></li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </div>
                                            <div class="date-time-block">
                                                <h4 class="title"><?php echo e(__('Availability On')); ?> <time class="time_slog_date"><?php echo e(date('D, d F, Y')); ?></time></h4>
                                                <p class="alert alert-warning " id="time_slot_warning"><?php echo e(__('select date first')); ?></p>
                                                <ul class="time-slot time" id="time_slot_wrapper">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-part">
                                            <div class="form-wrapper">

                                                <div class="billing-details-wrapper">
                                                    <div class="order-tab-wrap">
                                                        <nav>
                                                            <div class="nav nav-tabs" role="tablist">
                                                                <?php if(!auth()->guard('web')->check()): ?>
                                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"  aria-selected="true"><i class="fas fa-user"></i></a>
                                                                <?php endif; ?>
                                                                <a class="nav-item nav-link  <?php if(auth()->check()): ?> active <?php else: ?> disabled <?php endif; ?>" disabled id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-address-book"></i></a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" >
                                                            <?php if(!auth()->guard('web')->check()): ?>
                                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                                                    <?php if(get_static_option('disable_guest_mode_for_appointment_module')): ?>
                                                                    <div class="checkout-type margin-bottom-30  <?php if(auth()->guard('web')->check()): ?> d-none <?php endif; ?> ">
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                                                            <label class="custom-control-label" for="guest_logout"><?php echo e(__('Guest Order')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <?php if(!auth()->guard('web')->check()): ?>
                                                                        <?php echo $__env->make('frontend.partials.ajax-login-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                    <?php else: ?>
                                                                        <div class="alert alert-success">
                                                                            <?php echo e(__('Your Are Logged In As')); ?> <?php echo e(auth()->guard('web')->user()->name); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if(!auth()->guard('web')->check()): ?>
                                                                        <div class="next-step">
                                                                            <button class="next-step-btn btn-boxed" style="display: none" type="button"><?php echo e(__('Next Step')); ?></button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="tab-pane fade <?php if(auth()->guard('web')->check()): ?> show active <?php endif; ?>" id="nav-profile" role="tabpanel">

                                                                <h3 class="title"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_information_text')); ?></h3>
                                                                <form action="<?php echo e(route('frontend.appointment.booking')); ?>" method="post" class="appointment-booking-form" id="appointment-booking-form" enctype="multipart/form-data">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="error-message"></div>
                                                                    <input type="hidden" name="booking_date">
                                                                    <input type="hidden" name="booking_time_id">
                                                                    <input type="hidden" name="appointment_id" value="<?php echo e($item->id); ?>">
                                                                    <div class="form-group">
                                                                        <input type="text" name="name" class="form-control" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e(auth()->guard('web')->check() ? auth()->guard('web')->user()->name : ''); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="email" name="email" class="form-control" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(auth()->guard('web')->check() ? auth()->guard('web')->user()->email : ''); ?>">
                                                                    </div>
                                                                    <?php echo render_form_field_for_frontend(get_static_option('appointment_booking_page_form_fields')); ?>


                                                                    <?php if(!empty($item->price)): ?>
                                                                        <?php echo render_payment_gateway_for_form(false); ?>

                                                                        <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                                                            <div class="form-group manual_payment_transaction_field" <?php if( get_static_option('site_default_payment_gateway') === 'manual_payment'): ?> style="display: block;"<?php endif; ?> >
                                                                                <div class="label mb-2"><?php echo e(__('Attach your bank Document')); ?></div>
                                                                                <input class="form-control btn btn-primary btn-sm pb-2 pt-2" type="file" name="manual_payment_attachment">
                                                                                <span class="help-info mt-2"><?php echo get_manual_payment_description(); ?></span>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <div class="button-wrap">
                                                                        <button type="submit" class="btn-boxed appointment appo_booking_btn"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_button_text')); ?> <i class="fas fa-spinner fa-spin d-none"></i></button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                       <div class="alert alert-warning"> <?php echo e(__('Not Available')); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="nav-feedback" role="tabpanel" >
                                    <div class="feedback-wrapper">
                                        <?php if(auth()->guard('web')->check()): ?>
                                        <div class="feedback-form-wrapper">
                                            <h3 class="title"><?php echo e(__('Leave your feedback')); ?></h3>
                                            <form action="<?php echo e(route('frontend.appointment.review')); ?>" method="post" class="appointment-booking-form" id="appointment_rating_form">
                                                <?php echo csrf_field(); ?>
                                                <div class="error-message"></div>
                                                <input type="hidden" name="appointment_id" value="<?php echo e($item->id); ?>">
                                                <div class="form-group">
                                                    <label for="rating-empty-clearable2"><?php echo e(__('Ratings')); ?></label>
                                                    <input type="number" name="ratings"
                                                           id="rating-empty-clearable2"
                                                           class="rating text-warning"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><?php echo e(__('Message')); ?></label>
                                                    <textarea name="message" cols="30" class="form-control" rows="5"></textarea>
                                                </div>
                                                <button type="submit" class="btn-boxed appointment" id="appointment_ratings"><?php echo e(__('Submit')); ?>  <i class="fas fa-spinner fa-spin d-none"></i></button>
                                            </form>
                                        </div>
                                        <?php else: ?>
                                            <?php echo $__env->make('frontend.partials.ajax-login-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                        <?php if(count($item->reviews) > 0): ?>
                                        <div class="feedback-comment-list-wrap margin-top-40">
                                            <h3 class="title"><?php echo e(get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_client_feedback_title')); ?></h3>
                                            <ul class="feedback-list">
                                                <?php $__currentLoopData = $item->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="single-feedback-item">
                                                    <div class="content">
                                                        <h4 class="title"><?php echo e($data->user ? optional($data->user)->username : __("Anonymous")); ?></h4>
                                                        <div class="rating-wrap single">
                                                           <?php for( $i =1; $i <= $data->ratings; $i++ ): ?>
                                                               <i class="fas fa-star"></i>
                                                           <?php endfor; ?>
                                                        </div>
                                                        <div class="description"><?php echo e($data->message); ?></div>
                                                    </div>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
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
    <script type="text/javascript" src="//use.fontawesome.com/5ac93d4ca8.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/frontend/js/bootstrap4-rating-input.js')); ?>"></script>
    <?php echo $__env->make('frontend.partials.ajax-login-form-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        (function ($){
            "use strict";

            $(document).on('change','#guest_logout',function (e) {
                e.preventDefault();
                var infoTab = $('#nav-profile-tab');
                var nextBtn = $('.next-step-btn');
                if($(this).is(':checked')){
                    $('.booking-wrap .login-form').hide();
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

            $(document).on('click','.time-slot.date li',function (e){
                e.preventDefault();

                var date = $(this).data('date');
                date = date.split('-');
                var showDate = new Date(date[2]+'-'+ date[1]+'-'+date[0]);
                $('.time_slog_date').text(showDate.toDateString());
                $(this).toggleClass('selected').siblings().removeClass('selected');
                $('input[name="booking_date"]').val($(this).data('date'));
                //frontend.appointment.booking.time.check
                $('#time_slot_warning').show();
                $('#time_slot_warning').text('Loading Available Times..');
                $('#time_slot_wrapper').html('');

                $.ajax({
                    url: "<?php echo e(route('frontend.appointment.booking.time.check')); ?>",
                    type: 'post',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        date : $(this).data('date'),
                        appointment_id : '<?php echo e($item->id); ?>'
                    },
                    success: function(data){
                        console.log(data);
                       
                        $.each(data.available_booking_time,function(index,value){
                            if(value != false){
                                $('#time_slot_wrapper').append('<li data-id="'+value.id+'">'+value.time+'</li>');
                                $('#time_slot_warning').hide();
                            }else {
                                $('#time_slot_warning').text('no booking time available this date');
                                $('#time_slot_warning').show();
                            }
                        });
                        //append time slot for the current selected item
                    }
                });
            });

            $(document).on('click','.time-slot.time li',function (e){
                e.preventDefault();
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="booking_time_id"]').val($(this).data('id'));
            });


            $(document).on('click', '#appointment_ratings', function (e) {
                e.preventDefault();
                var myForm = document.getElementById('appointment_rating_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('frontend.appointment.review')); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#appointment_ratings').children('i').removeClass('d-none');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        $('#appointment_ratings').children('i').addClass('d-none');
                        errMsgContainer.html('');
                        errMsgContainer.append('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');

                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#appointment_ratings').children('i').addClass('d-none');
                    }
                });
            });

            //appo_booking_btn
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/appointment/single.blade.php ENDPATH**/ ?>