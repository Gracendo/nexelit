<?php
    $rtl_condition = get_user_lang_direction() == 'rtl' ? 'true' : 'false';
?>
<div class="header-style-03 header-variant-21">
    <nav class="navbar navbar-area nav-absolute navbar-expand-lg">
        <div class="container container-three nav-container">
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
                <a href="javascript:void(0)" class="click-content-show">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>
            <div class="nav-right-content right-contents-show">
                <div class="sidebar-area">
                    <ul>
                        <li class="bars">
                            <a href="javascript:void(0)">
                                <div class="side-bars">
                                    <span class="bar-line"></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="banner-area home-21 home-21-section-bg">
    <?php
        $all_header_social_icon_fields =  filter_static_option_value('home21_header_section_social_url',$static_field_data);
        $all_header_social_icon_fields = !empty($all_header_social_icon_fields) ? unserialize($all_header_social_icon_fields,['class' => false]) : [];
        $all_header_title_fields = filter_static_option_value('home_21_header_section_'.$user_select_lang_slug.'_social_text',$static_field_data);
        $all_header_title_fields = !empty($all_header_title_fields) ? unserialize($all_header_title_fields,['class' => false]) : [];
    ?>
    <div class="banner-social-links">
        <?php $__currentLoopData = $all_header_social_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="social-item" href="<?php echo e($icon_field); ?>"> <?php echo e($all_header_title_fields[$loop->index] ?? ''); ?> </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="banner-bottom-mask">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home21_header_section_background_image',$static_field_data)); ?>

    </div>
    <div class="agency-top-thumb">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home21_header_section_text_image',$static_field_data)); ?>

    </div>
    <div class="container container-three">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="banner-wrapper-thumb">
                    <div class="banner-thumb-shape">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home21_header_section_shape_02_image',$static_field_data)); ?>

                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home21_header_section_shape_01_image',$static_field_data)); ?>

                    </div>
                    <div class="banner-single-thumb">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home21_header_section_right_image',$static_field_data)); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-content-wrapper">
                    <div class="banner-contents">
                        <h1 class="banner-title">
                            <?php
                            $header_title = filter_static_option_value('home_21_header_section_'.$user_select_lang_slug.'_title',$static_field_data);
                            $header_title = str_replace(['{shape}','{/shape}'],['<span class="banner-title-shape">'.render_image_markup_by_attachment_id(filter_static_option_value('home21_header_section_title_shape_image',$static_field_data)),'</span>'],$header_title);
                            ?>
                            <?php echo $header_title; ?>

                        </h1>
                        <div class="banner-small-title">
                            <?php echo filter_static_option_value('home_21_header_section_'.$user_select_lang_slug.'_description',$static_field_data); ?>

                        </div>
                        <div class="banner-btn-contents mt-lg-5 mt-4">
                            <div class="btn-wrapper">
                                <a href="<?php echo e(get_static_option('home21_header_section_button_one_url')); ?>" class="cmn-btn btn-bg-heading radius-0"> <?php echo e(filter_static_option_value('home_21_header_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)); ?> </a>
                            </div>
                            <span class="need-help"><?php echo e(filter_static_option_value('home_21_header_section_'.$user_select_lang_slug.'_button_two_info_text',$static_field_data)); ?> <a href="<?php echo e(get_static_option('home21_header_section_button_two_url')); ?>"> <?php echo e(filter_static_option_value('home_21_header_section_'.$user_select_lang_slug.'_button_two_text',$static_field_data)); ?> </a> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="service-area home-21 padding-top-70 padding-bottom-50">
    <div class="service-shapes">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home21_services_section_left_shape_image',$static_field_data)); ?>

        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home21_services_section_right_shape_image',$static_field_data)); ?>

    </div>
    <div class="container container-three">
        <div class="row">
            <div class="col-lg-4 margin-top-30">
                <div class="single-service-wrapper">
                    <div class="section-title-21">
                        <span class="subtitle color-light mb-3"> <?php echo e(filter_static_option_value('home_21_service_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?> </span>
                        <?php
                            $header_title = filter_static_option_value('home_21_service_section_'.$user_select_lang_slug.'_title',$static_field_data);
                            $header_title = str_replace(['{shape}','{/shape}'],['<span class="section-shape">','</span>'],$header_title);
                        ?>
                        <h2 class="title"><?php echo $header_title; ?></h2>
                    </div>
                    <div class="service-wrapper-contents mt-4">
                        <p class="service-para color-light">
                            <?php echo e(filter_static_option_value('home_21_service_section_'.$user_select_lang_slug.'_description',$static_field_data)); ?>

                        </p>
                        <?php if(!empty(filter_static_option_value('home_21_service_section_button_one_url',$static_field_data))): ?>
                        <div class="btn-wrapper mt-4 mt-lg-5">
                            <a href="<?php echo e(filter_static_option_value('home_21_service_section_button_one_url',$static_field_data)); ?>" class="cmn-btn btn-bg-5 radius-0"> <?php echo e(filter_static_option_value('home_21_service_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)); ?> </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 margin-top-30">
                            <div class="single-service service-border">
                                <div class="service-icon">
                                    <?php if($service->icon_type === 'icon' || $service->icon_type == ''): ?>
                                        <i class="<?php echo e($service->icon); ?>"></i>
                                    <?php else: ?>
                                        <?php echo render_image_markup_by_attachment_id($service->img_icon); ?>

                                    <?php endif; ?>
                                </div>
                                <div class="service-content">
                                    <h3 class="service-title mt-4"> <a href="<?php echo e(route('frontend.services.single', $service->slug)); ?>"> <?php echo e($service->title); ?></a> </h3>
                                    <p class="service-para color-light mt-4"> <?php echo e($service->excerpt); ?> </p>
                                    <a href="<?php echo e(route('frontend.services.single', $service->slug)); ?>" class="explore-btn color-light mt-4">
                                        <?php echo e(filter_static_option_value('home_21_service_section_'.$user_select_lang_slug.'_item_explore_one_text',$static_field_data)); ?> <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="work-area home-21 padding-top-50 padding-bottom-100">
    <div class="container container-three">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-21">
                    <span class="subtitle color-light mb-3"> <?php echo e(filter_static_option_value('home_21_project_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?> </span>
                    <?php
                        $header_title = filter_static_option_value('home_21_project_section_'.$user_select_lang_slug.'_title',$static_field_data);
                        $header_title = str_replace(['{shape}','{/shape}'],['<span class="section-shape">','</span>'],$header_title);
                    ?>
                    <h2 class="title padding-right append-nav-work"> <?php echo $header_title; ?></h2>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-9">
                <div class="global-slick-init work-slider slider-inner-margin" data-rtl="<?php echo e($rtl_condition); ?>" data-appendArrows=".append-nav-work" data-infinite="true" data-arrows="true" data-dots="false" data-autoplaySpeed="3000" data-autoplay="true" data-prevArrow='<div class="prev-icon"><i class="fas fa-arrow-left"></i></div>'
                     data-nextArrow='<div class="next-icon"><i class="fas fa-arrow-right"></i></div>'>
                    <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-work-slider">
                            <div class="single-work">
                                <div class="work-thumb">
                                    <?php echo render_image_markup_by_attachment_id($work->image); ?>

                                </div>
                                <div class="work-contents">
                                    <span class="work-subtitle mb-3">
                                        <?php
                                        $work_categories = get_work_category_by_id($work->id,'link');
                                        foreach ($work_categories as $cat_id => $work_cat){
                                            printf('<a href="%1$s">%2$s</a>',route('frontend.works.category',['id' => $cat_id,'any' => Str::slug($work_cat)]),$work_cat);
                                        }
                                        ?>
                                    </span>
                                    <h3 class="work-title"><a href="<?php echo e(route('frontend.work.single',$work->slug)); ?>"><?php echo e($work->title); ?></a></h3>
                                    <p class="work-para mt-4"> <?php echo e($work->excerpt); ?> </p>
                                    <a href="<?php echo e(route('frontend.work.single',$work->slug)); ?>" class="case-btn mt-4"> <?php echo e(filter_static_option_value('home_21_project_section_'.$user_select_lang_slug.'_item_explore_one_text',$static_field_data)); ?> <i class="fas fa-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="counter-area home-21 home-21-section-bg padding-top-70 padding-bottom-100">
    <div class="counter-shape">
        <img src="assets/img/3line-s.png" alt="">
    </div>
    <div class="container container-three">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6 margin-top-30">
                <div class="counter-title-wrapper">
                    <div class="section-title-21">
                        <?php
                            $header_title = filter_static_option_value('home_21_counterup_section_'.$user_select_lang_slug.'_title',$static_field_data);
                            $header_title = str_replace(['{shape}','{/shape}'],['<span class="section-shape">','</span>'],$header_title);
                        ?>
                        <h2 class="title"><?php echo $header_title; ?></h2>
                    </div>
                    <p class="counter-title-para mt-3">
                    <?php echo e(filter_static_option_value('home_21_counterup_section_'.$user_select_lang_slug.'_description',$static_field_data)); ?>

                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="counter-wrapper">
                    <div class="row">
                        <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-6 col-md-4 col-sm-6 margin-top-30">
                                <div class="single-counter counter-border">
                                    <div class="counter-count">
                                        <h2 class="odometer odometer-auto-theme" data-odometer-final="<?php echo e($counter->number); ?>"><?php echo e($counter->number); ?></h2>
                                        <h4 class="count-title"><?php echo e($counter->extra_text); ?></h4>
                                    </div>
                                    <p class="counter-para color-light mt-2"> <?php echo e($counter->title); ?> </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-area home-21 padding-top-100 padding-bottom-100">
    <div class="container container-three">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-21">
                    <span class="subtitle mb-3"> <?php echo e(filter_static_option_value('home_21_blog_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?> </span>
                    <h2 class="title padding-right blog-append-nav">
                        <?php
                            $header_title = filter_static_option_value('home_21_blog_section_'.$user_select_lang_slug.'_title',$static_field_data);
                            $header_title = str_replace(['{shape}','{/shape}'],['<span class="section-shape">','</span>'],$header_title);
                        ?>
                        <?php echo $header_title; ?>

                    </h2>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="global-slick-init slider-inner-margin" data-rtl="<?php echo e($rtl_condition); ?>" data-appendArrows=".blog-append-nav" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="3" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="fas fa-arrow-left"></i></div>'
                     data-nextArrow='<div class="next-icon"><i class="fas fa-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"slidesToShow": 1}}]'>

                    <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slick-slider-items">
                            <div class="single-blog">
                                <div class="blog-thumb">
                                    <?php echo render_image_markup_by_attachment_id($blog->image,'','grid'); ?>

                                </div>
                                <div class="blog-contents mt-4">
                                    <h2 class="blog-title"> <a href="<?php echo e(route('frontend.blog.single', $blog->slug)); ?>"><?php echo e($blog->title); ?></a> </h2>
                                    <div class="blog-bottom mt-4">
                                        <a href="<?php echo e(route('frontend.blog.single', $blog->slug)); ?>" class="reading-btn"> <?php echo e(filter_static_option_value('home_21_blog_section_'.$user_select_lang_slug.'_item_keep_reading_text',$static_field_data)); ?> <i class="fas fa-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Feedback area Starts -->
<section class="feedback-area home-21 home-21-section-bg padding-top-70 padding-bottom-100">
    <div class="container container-three">
        <div class="row">
            <div class="col-lg-12">
                <div class="global-slick-init feedback-slider feedback-nav" data-rtl="<?php echo e($rtl_condition); ?>" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="1" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="fas fa-arrow-left"></i></div>'
                     data-nextArrow='<div class="next-icon"><i class="fas fa-arrow-right"></i></div>'>
                    <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slick-slider-item">
                            <div class="row align-items-center">
                                <div class="col-lg-5 margin-top-30">
                                    <div class="feedback-image-wrapper">
                                        <div class="feedback-thumb">
                                            <?php echo render_image_markup_by_attachment_id($test->image); ?>

                                        </div>
                                        <div class="feedback-shape-img">
                                            <img src="<?php echo e(('assets/frontend/img/feedback/quote.png')); ?>" alt="">
                                            <img src="<?php echo e(asset('assets/frontend/img/feedback/feedback-s.png')); ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 margin-top-30">
                                    <div class="feedback-contents-wrapper">
                                        <div class="section-title-21">
                                            <span class="subtitle color-light mb-3"> <?php echo e(filter_static_option_value('home_21_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?> </span>
                                            <h2 class="title">
                                                <?php
                                                    $header_title = filter_static_option_value('home_21_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data);
                                                    $header_title = str_replace(['{shape}','{/shape}'],['<span class="section-shape">','</span>'],$header_title);
                                                ?>
                                                <?php echo $header_title; ?>

                                            </h2>
                                        </div>
                                        <div class="feedback-contents mt-5">
                                            <p class="feedback-para"> <?php echo e($test->description); ?> </p>
                                            <div class="clients-contents mt-5">
                                                <h3 class="client-title"> <?php echo e($test->name); ?> </h3>
                                                <span class="client-subtitle color-light mt-2"> <?php echo e($test->designation); ?>  </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Feedback area end -->
<section class="connects-area home-21 padding-top-70 padding-bottom-50">
    <div class="container container-three">
        <div class="row">
            <div class="col-lg-6 margin-top-30">
                <div class="connects-content-wrapper">
                    <div class="section-title-21">
                        <h2 class="title">
                            <?php
                                $header_title = filter_static_option_value('home_21_contact_section_'.$user_select_lang_slug.'_title',$static_field_data);
                                $header_title = str_replace(['{shape}','{/shape}'],['<span class="section-shape">','</span>'],$header_title);
                            ?>
                            <?php echo $header_title; ?>

                        </h2>
                    </div>
                    <div class="connect-inner-content">
                        <?php
                            $all_icon_fields =  get_static_option('home21_contact_section_info_item_icon');
                            $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false]) : [];
                            $all_title_fields = get_static_option('home_21_contact_section_'.$user_select_lang_slug.'_info_item_title');
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
                            $all_details_fields = get_static_option('home_21_contact_section_'.$user_select_lang_slug.'_info_item_details');
                            $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields,['class' => false]) : [];
                        ?>
                        <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                        <div class="single-connects">
                            <div class="connect-icon">
                                <?php echo render_image_markup_by_attachment_id($icon_field); ?>

                            </div>
                            <div class="connect-content">
                                <h4 class="connect-title"> <?php echo e($all_title_fields[$loop->index] ?? ''); ?> </h4>
                                <?php
                                    $exploded_list = $all_details_fields[$loop->index] ?? '';
                                    $exploded_arr = explode("\n",$exploded_list);
                                ?>
                                <?php $__currentLoopData = $exploded_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="connect-item">  <?php echo e($exp); ?> </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 margin-top-30">
                <div class="connect-form-wrapper">

                    <form action="<?php echo e(route('frontend.get.touch')); ?>" id="get_in_touch_form" method="post" class="connect-form" enctype="multipart/form-data"
                          class="contact-page-form">
                        <div class="error-message"></div>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                        <div class="connect-form-inner">

                                <?php echo render_form_field_for_frontend(filter_static_option_value('get_in_touch_form_fields',$static_field_data)); ?>

                            <div class="btn-wrapper">
                                <button type="submit" id="get_in_touch_submit_btn"
                                        class="boxed-btn"><?php echo e(filter_static_option_value('home_21_contact_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?></button>
                                <div class="ajax-loading-wrap hide">
                                    <div class="sk-fading-circle">
                                        <div class="sk-circle1 sk-circle"></div>
                                        <div class="sk-circle2 sk-circle"></div>
                                        <div class="sk-circle3 sk-circle"></div>
                                        <div class="sk-circle4 sk-circle"></div>
                                        <div class="sk-circle5 sk-circle"></div>
                                        <div class="sk-circle6 sk-circle"></div>
                                        <div class="sk-circle7 sk-circle"></div>
                                        <div class="sk-circle8 sk-circle"></div>
                                        <div class="sk-circle9 sk-circle"></div>
                                        <div class="sk-circle10 sk-circle"></div>
                                        <div class="sk-circle11 sk-circle"></div>
                                        <div class="sk-circle12 sk-circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="newsletter-area home-21 home-21-section-bg padding-top-50 padding-bottom-50">
    <div class="newsletter-shape">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_21_newsletter_section_shape_image',$static_field_data)); ?>

    </div>
    <div class="container container-three">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="newsletter-wrapper center-text">
                    <div class="section-title-21">
                        <span class="subtitle color-light mb-3"> <?php echo e(filter_static_option_value('home_21_newsletter_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?> </span>
                        <h2 class="title">
                            <?php
                                $header_title = filter_static_option_value('home_21_newsletter_section_'.$user_select_lang_slug.'_title',$static_field_data);
                                $header_title = str_replace(['{shape}','{/shape}'],['<span class="section-shape">','</span>'],$header_title);
                            ?>
                            <?php echo $header_title; ?>

                        </h2>
                    </div>
                    <div class="newsletter-widget">
                        <div class="form-message-show"></div>
                        <div class="newsletter-form-wrap">
                            <form action="<?php echo e(route('frontend.subscribe.newsletter')); ?>" class="newsletter-form mt-4 mt-lg-5">
                                <div class="single-input">
                                    <input class="form--control" type="email" name="email" placeholder="<?php echo e(filter_static_option_value('home_21_newsletter_section_'.$user_select_lang_slug.'_placeholder_text',$static_field_data)); ?> ">
                                </div>
                                <button class="newsletter-btn submit-btn" type="submit"> <i class="fas fa-arrow-right"></i> </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="sidebars-wrappers home-21">
    <div class="sidebars-close"> <i class="fas fa-times"></i> </div>
    <div class="sidebar-inner">
        <div class="contents-wrapper">
            <?php echo App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('homepage_sidebar',['column' => false]); ?>

        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#get_in_touch_submit_btn', function (e) {
                e.preventDefault();
                var myForm = document.getElementById('get_in_touch_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('frontend.get.touch')); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#get_in_touch_form').find('.error-message');
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        errMsgContainer.html('');

                        if(data.status == '400'){
                            errMsgContainer.append('<span class="text-danger">'+data.msg+'</span>');
                        }else{
                            errMsgContainer.append('<span class="text-success">'+data.msg+'</span>');
                        }
                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#get_in_touch_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/home-pages/home-21.blade.php ENDPATH**/ ?>