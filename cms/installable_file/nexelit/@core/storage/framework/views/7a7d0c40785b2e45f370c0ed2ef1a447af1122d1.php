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
                        <?php if(!empty(filter_static_option_value('site_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)); ?>

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

<div class="header-slider-wrapper">
        <div class="header-area medical-home"
                <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('medical_home_page_header_background_image',$static_field_data)); ?>

        >
            <div class="right-image-wrap">
                <?php echo render_image_markup_by_attachment_id(filter_static_option_value('medical_home_page_header_right_image',$static_field_data)); ?>

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <h1 class="title"><?php echo e(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h1>
                            <p class="description"><?php echo e(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_description',$static_field_data)); ?></p>
                        
                            <div class="btn-wrapper margin-top-30">
                                <?php if(!empty(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('medical_home_page_header_button_url',$static_field_data)); ?>" class="boxed-btn medical"><?php echo e(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?></a>
                                <?php endif; ?>
                                <?php if(!empty(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_two_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('medical_home_page_header_button_two_url',$static_field_data)); ?>" class="boxed-btn medical blank"><?php echo e(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_two_text',$static_field_data)); ?></a>
                                <?php endif; ?>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-image-shape">
                <img src="<?php echo e(asset('assets/frontend/img/shape/header-bottom-shape.svg')); ?>" alt="header bottom image shape">
            </div>
            <div class="shape image-1">
                <img src="<?php echo e(asset('assets/frontend/img/shape/medical-left-top-shape.png')); ?>" alt="">
            </div>
            <div class="shape image-2">
                 <img src="<?php echo e(asset('assets/frontend/img/shape/medical-shape-two.png')); ?>" alt="">
            </div>
            <div class="shape image-3">
                 <img src="<?php echo e(asset('assets/frontend/img/shape/medical-shape.png')); ?>" alt="">
            </div>
        </div>
       
</div>
<?php if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data))): ?>
    <div class="medical-about-area padding-top-115 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <span class="subtitle"><?php echo e(filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                        <div class="description"><?php echo filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_description',$static_field_data); ?></div>
                        <div class="btn-wrapper">
                            <?php if(!empty(filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('medical_about_section_button_url',$static_field_data)); ?>"
                                   class="boxed-btn medical-home">
                                    <?php echo e(filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('medical_about_section_right_image',$static_field_data)); ?>

                        <div class="image-wapper">
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('medical_about_section_right_bottom_image',$static_field_data)); ?>

                            <?php if(!empty(filter_static_option_value('home_page_13_about_section_video_url',$static_field_data))): ?>
                            <div class="vdo-btn">
                                <a href="<?php echo e(filter_static_option_value('home_page_13_about_section_video_url',$static_field_data)); ?>" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i> </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
    <div class="political-what-we-offer-area padding-top-60 padding-bottom-30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_service_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $a=0; ?>
                <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="political-single-what-we-cover-item  margin-bottom-30">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($data->image,'grid'); ?>

                                <div class="icon style-<?php echo e($a); ?>">
                                    <i class="<?php echo e($data->icon); ?>"></i>  
                                </div>
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?></a>
                                </h4>
                                <p><?php echo e($data->excerpt); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php ($a == 6) ? $a= 1 : $a++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_appointment_section_status',$static_field_data))): ?>
    <div class="const-team-member-area padding-top-60 padding-bottom-120 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_appointment_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_appointment_section_title',$static_field_data)); ?></h2>
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
                            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="appointment-single-item medical-home">
                                    <div class="thumb"
                                            <?php echo render_background_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                    >
                                        <div class="cat">
                                            <a href="<?php echo e(route('frontend.appointment.category',['id' => $data->category->id,'any' => Str::slug($data->category->lang_front->title ?? __("Uncategorized"))])); ?>"><?php echo e($data->category->lang_front->title ?? __("Uncategorized")); ?></a>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <?php if(!empty($data->lang_front->designation)): ?>
                                            <span class="designation"><?php echo e($data->lang_front->designation); ?></span>
                                        <?php endif; ?>
                                        <?php if(count($data->reviews) > 0): ?>
                                            <div class="rating-wrap">
                                                <div class="ratings">
                                                    <span class="hide-rating"></span>
                                                    <span class="show-rating" style="width: <?php echo e(get_appointment_ratings_avg_by_id($data->id) / 5 * 100); ?>%"></span>
                                                </div>
                                                <p><span class="total-ratings">(<?php echo e(count($data->reviews)); ?>)</span></p>
                                            </div>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('frontend.appointment.single',[$data->lang_front->slug ?? __('untitled'),$data->id])); ?>"><h4 class="title"><?php echo e($data->lang_front->title ?? ''); ?></h4></a>
                                        <?php if(!empty($data->lang_front->location)): ?>
                                            <span class="location"><i class="fas fa-map-marker-alt"></i><?php echo e($data->lang_front->location ?? ''); ?></span>
                                        <?php endif; ?>

                                        <p><?php echo e(Str::words(strip_tags($data->lang_front->short_description ?? ''),10)); ?></p>
                                        <div class="btn-wrapper">
                                            <a href="<?php echo e(route('frontend.appointment.single',[$data->lang_front->slug ?? __('untitled'),$data->id])); ?>" class="boxed-btn"><?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_booking_button_text')); ?></a>
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
<section class="appointment-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="appointment-inner-area">
                    <div class="left-content-area">
                        <span class="subtitle"><?php echo e(filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h3 class="title"><?php echo e(filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h3>
                        <div class="description"><?php echo filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_description',$static_field_data); ?></div>
                        <h5 class="helpline"><?php echo e(filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_hotline',$static_field_data)); ?></h5>
                    </div>
                    <div class="right-content-area">
                        <form action="<?php echo e(route('frontend.appointment.message')); ?>" method="post" class="contact-page-form" id="appointment_form" enctype="multipart/form-data">
                            <div class="error-message"></div>
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <?php echo render_form_field_for_frontend(get_static_option('appointment_form_fields')); ?>

                            <div class="btn-wrapper">
                                <button type="submit" class="boxed-btn medical-home" id="submit_appointment_btn"><?php echo e(filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
    <div class="medical-counterup-area medical-section-bg-color padding-top-115 padding-bottom-115">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="medical-home-counterup-item">
                            <div class="icon style-<?php echo e($loop->index); ?>">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                           <div class="content">
                               <div class="count-wrap">
                                   <span class="count-num"><?php echo e($data->number); ?></span><?php echo e($data->extra_text); ?>

                               </div>
                               <h4 class="title"><?php echo e($data->title); ?></h4>
                           </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data))): ?>
    <div class="medical-project-area padding-top-60 padding-bottom-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_case_study_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_case_study_section_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="case-studies-masonry-wrapper global-carousel-init"
             data-loop="true"
             data-desktopitem="4"
             data-mobileitem="1"
             data-tabletitem="2"
             data-nav="false"
             data-dots="true"
             data-autoplay="true"
             data-margin="30"
        >
            <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="const-single-case-study-style-02 medical-home">
                    <div class="thumb">
                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                    </div>
                    <div class="cart-icon">
                        <h4 class="title">
                            <a href="<?php echo e(route('frontend.work.single',$data->slug)); ?>"> <?php echo e($data->title); ?></a>
                        </h4>
                        <div class="cat-wrapper">
                            <?php
                                $all_cat =  get_work_category_by_id($data->id)
                            ?>
                            <?php $__currentLoopData = $all_cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catid => $can_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('frontend.works.category',['id' => $catid, 'any' => $can_name ? Str::slug($can_name) : ''])); ?>"><?php echo e($can_name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
<div class="logistic-testimonial-area padding-top-60 padding-bottom-120" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 medical-home">
                    <span class="subtitle"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-carousel-area margin-top-10 ">
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
                            <div class="logistic-single-testimonial-item medical-home">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description "><?php echo e($data->description); ?></p>
                                    <div class="author-details ">
                                        <h4 class="title "><?php echo e($data->name); ?></h4>
                                        <span class="designation "><?php echo e($data->designation); ?></span>
                                    </div>
                                </div>
                                <div class="thumb ">
                                    <?php echo render_image_markup_by_attachment_id($data->image); ?>

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

<?php if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data))): ?>
    <div class="const-news-area padding-bottom-120 industry-section-bg padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_news_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_news_section_title',$static_field_data)); ?></h2>
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
                                <div class="single-portfolio-blog-grid medical-home">
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
                                        <a class="readmore" href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_news_section_readmore_text',$static_field_data)); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
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
    <div class="client-section padding-bottom-70 padding-top-85">
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
    <script>
        $(document).ready(function () {
            $(document).on('click', '#submit_appointment_btn', function (e) {
                e.preventDefault();
                var buttonText = $(this).text();
                var myForm = document.getElementById('appointment_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('frontend.appointment.message')); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                       $('#submit_appointment_btn').text('<?php echo e(__('Please Wait..')); ?>')
                    },
                    success: function (data) {
                        var errMsgContainer = $('#appointment_form').find('.error-message');
                        $('#submit_appointment_btn').text('<?php echo e(filter_static_option_value('medical_appointment_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?>')
                        errMsgContainer.html('');
                        if(data.status == '400'){
                            errMsgContainer.append('<span class="text-danger">'+data.msg+'</span>');
                        }else{
                            errMsgContainer.append('<span class="text-success">'+data.msg+'</span>');
                        }
                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#appointment_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#submit_appointment_btn').text('<?php echo e(filter_static_option_value('medical_appointment_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?>');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/home-pages/home-12.blade.php ENDPATH**/ ?>