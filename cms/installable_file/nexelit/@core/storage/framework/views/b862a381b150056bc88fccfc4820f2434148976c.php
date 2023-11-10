<?php echo $__env->make('frontend.partials.homesupportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $home_page_variant =$home_page ?? get_static_option('home_page_variant');
?>
<div class="header-style-03  header-variant-<?php echo e($home_page_variant); ?>">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <?php if(!empty(filter_static_option_value('site_white_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_white_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                    </a>
                </div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-cart-mobile','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product-cart-mobile'); ?>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>
            <div class="nav-right-content">
                <div class="icon-part">
                    <ul>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-search','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar-search'); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-cart','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product-cart'); ?>
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
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="header-slider-wrapper global-carousel-init charity-home"
     data-loop="true"
     data-desktopitem="1"
     data-mobileitem="1"
     data-tabletitem="1"
     data-dots="true"
     data-autoplay="true"
     data-stagepadding="0"
     data-margin="0"
>
    <?php
        $all_bg_image_fields =  filter_static_option_value('home_page_13_header_section_bg_image',$static_field_data);
        $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields,['class' => false]) : [];
        $all_button_one_icon_fields =  filter_static_option_value('home_page_13_header_section_button_one_icon',$static_field_data);
        $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields,['class' => false]) : [];
        $all_button_one_url_fields =  filter_static_option_value('home_page_13_header_section_button_one_url',$static_field_data);
        $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields,['class' => false]) : [];
        $all_description_fields = filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
        $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
        $all_btn_one_text_fields = filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
        $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields,['class' => false]) : [];
        $all_title_fields = filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
        $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
        $all_subtitle_fields = filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_header_section_subtitle',$static_field_data);
        $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];
    ?>
    <?php $__currentLoopData = $all_bg_image_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="header-area charity-home">
            <div class="right-image-wrap">
                <?php echo render_image_markup_by_attachment_id($image); ?>

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <span class="subtitle"><?php echo e($all_subtitle_fields[$loop->index] ?? ''); ?></span>
                            <h1 class="title"><?php echo e($all_title_fields[$loop->index] ?? ''); ?></h1>
                            <p class="description"><?php echo e($all_description_fields[$loop->index] ?? ''); ?></p>
                            <div class="btn-wrapper margin-top-30">
                                <?php if(isset($all_btn_one_text_fields[$loop->index])): ?>
                                    <a href="<?php echo e($all_button_one_url_fields[$loop->index] ?? ''); ?>"
                                       class="btn-charity"><?php echo e($all_btn_one_text_fields[$loop->index] ?? ''); ?> <i
                                                class="<?php echo e($all_button_one_icon_fields[$loop->index] ?? ''); ?>"></i></a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-image-shape">
                <img src="<?php echo e(asset('assets/frontend/img/shape/charity-header-bottom-shape.svg')); ?>"
                     alt="header bottom image shape">
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data))): ?>
    <div class="charity-about-area padding-top-115 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_about_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_about_section_title',$static_field_data)); ?></h2>
                        <div class="description"><?php echo filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_about_section_description',$static_field_data); ?></div>
                        <div class="btn-wrapper">
                            <?php if(!empty(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_about_section_button_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('home_page_13_about_section_button_url',$static_field_data)); ?>"
                                   class="btn-charity reverse-color">
                                    <?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_about_section_button_text',$static_field_data)); ?>

                                    <i class="<?php echo e(filter_static_option_value('home_page_13_about_section_button_icon',$static_field_data)); ?>"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <div class="image-wrapper">
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_13_about_section_right_image',$static_field_data)); ?>

                            <div class="vdo-btn">
                                <a href="<?php echo e(filter_static_option_value('home_page_13_about_section_video_url',$static_field_data)); ?>"
                                   class="video-play-btn mfp-iframe"><i class="fas fa-play"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_donation_cause_section_status',$static_field_data))): ?>
    <div class="latest-cause-area padding-top-115 padding-bottom-120"
            <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_13_popular_cause_popular_cause_background_image',$static_field_data)); ?>>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 charity-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_popular_cause_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_popular_cause_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $popular_causes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-popular-cause-item">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($data->image,'grid'); ?>

                            </div>
                            <div class="content">
                                <a href="<?php echo e(route('frontend.donations.single',$data->slug)); ?>"><h4
                                            class="title"><?php echo e($data->title); ?></h4></a>
                                <p><?php echo e(strip_tags(Str::words(strip_tags($data->donation_content),20))); ?></p>
                                <div class="thumb-content">
                                    <div class="progress-item">
                                        <div class="donation-progress style-<?php echo e($loop->index); ?>"
                                             data-percent="<?php echo e(get_percentage($data->amount,$data->raised)); ?>"></div>
                                    </div>
                                    <div class="goal">
                                        <h4 class="raised"><span><?php echo e(get_static_option('home_page_13_'.$user_select_lang_slug.'_popular_cause_rise_text')); ?>:</span> <?php if(!empty($data->raised)): ?><?php echo e(amount_with_currency_symbol($data->raised)); ?><?php else: ?> <?php echo e(amount_with_currency_symbol(0)); ?> <?php endif; ?>
                                        </h4>
                                        <h4 class="raised"><span><?php echo e(get_static_option('home_page_13_'.$user_select_lang_slug.'_popular_cause_goal_text')); ?>:</span> <?php echo e(amount_with_currency_symbol($data->amount)); ?>

                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_team_member_section_status',$static_field_data))): ?>
    <div class="const-team-member-area padding-top-120 padding-bottom-120 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 charity-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_team_member_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_team_member_section_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="team-member-carousel-area margin-top-10 ">
                        <div class="industry-member-carousel global-carousel-init logistic-dots lawyer-home"
                             data-loop="true"
                             data-desktopitem="4"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-stagepadding="0"
                             data-margin="30"
                        >
                            <?php $a=0; ?>
                            <?php $__currentLoopData = $all_team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="charity-team-single-item">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                        <div class="content style-<?php echo e($a); ?>">
                                            <h4 class="title"><?php echo e($data->name); ?></h4>
                                            <span><?php echo e($data->designation); ?></span>
                                            <?php
                                                $social_fields = array(
                                                    'icon_one' => 'icon_one_url',
                                                    'icon_two' => 'icon_two_url',
                                                    'icon_three' => 'icon_three_url',
                                                );
                                            ?>
                                            <ul class="social-icons">
                                                <?php $__currentLoopData = $social_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e($data->$value); ?>" rel="canonical"><i class="<?php echo e($data->$key); ?>"></i></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php ($a == 4) ? $a= 1 : $a++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data))): ?>
    <div class="charity-cta-area"
            <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_13_cta_area_background_image',$static_field_data)); ?>

    >
        <div class="shape top">
            <img src="<?php echo e(asset('assets/frontend/img/shape/cta-top-shape.svg')); ?>" alt="">
        </div>
        <div class="shape bottom">
            <img src="<?php echo e(asset('assets/frontend/img/shape/cta-bottom-shape.svg')); ?>" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-area-inner">
                        <div class="left-content-area">
                            <h3 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)); ?></h3>
                        </div>
                        <div class="right-content-area">
                            <?php if(!empty(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data))): ?>
                                <div class="btn-wrapper">
                                    <a href="<?php echo e(filter_static_option_value('home_page_13_cta_area_button_url',$static_field_data)); ?>"
                                       class="btn-charity"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)); ?>

                                        <i class="<?php echo e(filter_static_option_value('home_page_13_cta_section_button_icon',$static_field_data)); ?>"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_event_section_status',$static_field_data))): ?>
    <div class="charity-event-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 charity-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_event_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_event_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="event-masonry-wrapper global-carousel-init"
                         data-loop="true"
                         data-desktopitem="3"
                         data-mobileitem="1"
                         data-tabletitem="2"
                         data-nav="false"
                         data-dots="true"
                         data-autoplay="true"
                         data-margin="30"
                    >
                        <?php $a = 0; ?>
                        <?php $__currentLoopData = $all_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="charity-single-event-item-wrap">
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image,'grid'); ?>

                                    <div class="time-wrap style-<?php echo e($a); ?>">
                                        <span class="date"><?php echo e(date('d',strtotime($data->date))); ?></span>
                                        <span class="month"><?php echo e(date('M',strtotime($data->date))); ?></span>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a
                                                href="<?php echo e(route('frontend.events.single',$data->slug)); ?>"><?php echo e($data->title); ?></a>
                                    </h4>
                                    <div class="description"><?php echo e(strip_tags(Str::words(strip_tags($data->content),20))); ?></div>
                                    <ul>
                                        <li><i class="far fa-clock"></i> <?php echo e($data->time); ?></li>
                                        <li><i class="fas fa-map-marker-alt"></i> <?php echo e($data->venue_location); ?></li>
                                    </ul>
                                </div>
                            </div>
                            <?php ($a == 2) ? $a = 0 : $a++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
    <div class="logistic-testimonial-area padding-top-120 padding-bottom-200"
    <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_13_testimonial_section_background_image',$static_field_data)); ?>

    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 charity-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="testimonial-carousel-area">
                        <div class="global-carousel-init logistic-dots"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="charity-single-testimonial-item">
                                    <div class="icon">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div class="content">
                                        <p class="description"><?php echo e($data->description); ?></p>
                                        <div class="author-details ">
                                            <h4 class="title "><?php echo e($data->name); ?></h4>
                                            <span class="designation "><?php echo e($data->designation); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data))): ?>
<div class="charity-cta-two-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cta-inner">
                    <div class="left-content">
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_cta_two_area_title',$static_field_data)); ?></h2>
                    </div>
                    <div class="right-content">
                        <?php if(!empty(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_cta_two_area_button_status',$static_field_data))): ?>
                        <div class="btn-wrapper">
                            <a href="<?php echo e(filter_static_option_value('home_page_13_cta_two_area_button_url',$static_field_data)); ?>" class="btn-charity"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_cta_two_area_button_title',$static_field_data)); ?> <i class="<?php echo e(filter_static_option_value('home_page_13_cta_two_section_button_icon',$static_field_data)); ?>"></i></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data))): ?>
    <div class="const-news-area padding-bottom-60 padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 charity-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_new_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_new_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-carosel-wrapper">
                        <div class="global-carousel-init logistic-dots lawyer-home"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-portfolio-blog-grid charity-home">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image,'thumb'); ?>

                                        <div class="time-wrap">
                                            <span class="date"><?php echo e(date_format($data->created_at,'d')); ?></span>
                                            <span class="month"><?php echo e(date_format($data->created_at,'M')); ?></span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a>
                                        </h4>
                                        <a class="readmore"
                                           href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(filter_static_option_value('home_page_13_'.$user_select_lang_slug.'_new_area_button_text',$static_field_data)); ?>

                                            <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data))): ?>
    <div class="client-section padding-bottom-70 padding-top-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init"
                             data-loop="true"
                             data-desktopitem="5"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-autoplay="true"
                             data-margin="80"
                        >
                            <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-brand">
                                    <div class="img-wrapper">
                                        <?php if(!empty($data->url) ): ?><a rel="canonical" href="<?php echo e($data->url); ?>"><?php endif; ?>
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                            <?php if(!empty($data->url) ): ?>  </a><?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>
    <script>
        (function ($) {
            'use strict';
            var allProgress = $('.donation-progress');
            $.each(allProgress, function (index, value) {
                $(this).rProgressbar({
                    percentage: $(this).data('percent'),
                    fillBackgroundColor: "<?php echo e(get_static_option('site_color')); ?>"
                });
            })
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/home-pages/home-13.blade.php ENDPATH**/ ?>