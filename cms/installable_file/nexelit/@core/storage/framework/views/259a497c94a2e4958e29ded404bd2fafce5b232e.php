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

<div class="header-slider-wrapper">
        <div class="header-area political-home"
                <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('political_home_page_header_background_image',$static_field_data)); ?>

        >
            <div class="left-image-wrap">
                <?php echo render_image_markup_by_attachment_id(filter_static_option_value('political_home_page_header_left_image',$static_field_data)); ?>

            </div>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <h1 class="title"><?php echo e(filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h1>
                            <p class="description"><?php echo e(filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_description',$static_field_data)); ?></p>
                            <?php if(!empty(filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data))): ?>
                            <div class="btn-wrapper margint-top-30">
                                <a href="<?php echo e(filter_static_option_value('political_home_page_header_button_url',$static_field_data)); ?>" class="boxed-btn political"><?php echo e(filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php if(!empty(filter_static_option_value('home_page_key_feature_section_status',$static_field_data))): ?>
<div class="header-bottom-area margin-minus-100">
    <div class="container">
        <div class="row">
            <?php
                $all_button_one_icon_fields =  filter_static_option_value('home_page_11_key_features_section_icon',$static_field_data);
                $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields) : [];
                $all_title_fields = filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_key_features_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
            ?>
            <div class="col-lg-12">
                <ul class="political-feature-list">
                    <?php $__currentLoopData = $all_button_one_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="single-political-list-item style-<?php echo e($index); ?>">
                        <div class="icon">
                            <i class="<?php echo e($icon); ?>"></i>
                        </div>
                        <h3 class="title"><?php echo e($all_title_fields[$index] ?? ''); ?></h3>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data))): ?>
    <div class="lawyer-about-area political-home padding-top-115 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <span class="subtitle"><?php echo e(filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                        <div class="description"><?php echo filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_description',$static_field_data); ?></div>
                        <div class="btn-wrapper">
                            <?php if(!empty(filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('political_about_section_button_url',$static_field_data)); ?>"
                                   class="boxed-btn lawyer-home">
                                    <?php echo e(filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('political_about_section_right_image',$static_field_data)); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<section class="video-and-cta-area">
    <?php if(!empty(filter_static_option_value('home_page_video_section_status',$static_field_data))): ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="political-video-wrap">
                    <div class="img-wrap">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_11_video_area_background_image',$static_field_data)); ?>

                        <a href="<?php echo e(filter_static_option_value('home_page_11_video_area_video_url',$static_field_data)); ?>" class="mfp-iframe video-play-btn"><i class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data))): ?>
    <div class="political-cta-area-wrapper" 
    <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_11_cta_area_background_image',$static_field_data)); ?>

    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-area-inner">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_subtitle',$static_field_data)); ?></span>
                        <h3 class="title"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)); ?></h3>
                        <p><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_description',$static_field_data)); ?> </p>
                        <?php if(!empty(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data))): ?>
                        <div class="btn-wrapper">
                            <a href="<?php echo e(filter_static_option_value('home_page_11_cta_area_button_url',$static_field_data)); ?>" class="boxed-btn political-home"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
    <div class="political-what-we-offer-area padding-top-120 industry-section-bg padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 political-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_service_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="political-single-what-we-cover-item  margin-bottom-30">
                            <div class="hover">
                                <h4 class="title"><a
                                    href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?></a>
                                </h4>
                                <p><?php echo e($data->excerpt); ?></p>
                            </div>
                            <?php echo render_image_markup_by_attachment_id($data->image,'grid'); ?>

                            <div class="content">
                                <h4 class="title">
                                    <a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?></a>
                                </h4>
                                <a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"
                                   class="readmore"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_service_area_readmore_text',$static_field_data)); ?>

                                    <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
    <div class="lawyer-counterup-area padding-top-115 padding-bottom-115"
    <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_11_counterup_section_background_image',$static_field_data)); ?>

    >
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="lawyer-home-counterup-item">
                            <div class="icon">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            <div class="count-wrap"><span
                                        class="count-num"><?php echo e($data->number); ?></span><?php echo e($data->extra_text); ?></div>
                            <h4 class="title"><?php echo e($data->title); ?></h4>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_event_section_status',$static_field_data))): ?>
<section class="event-area padding-top-120 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_event_area_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_event_area_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php $a = 0; ?> 
                <?php $__currentLoopData = $all_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="political-single-event-item-wrap">
                    <div class="thumb">
                        <?php echo render_image_markup_by_attachment_id($data->image,'grid'); ?>

                        <div class="time-wrap style-<?php echo e($a); ?>">
                            <span class="date"><?php echo e(date('d',strtotime($data->date))); ?></span>
                            <span class="month"><?php echo e(date('M',strtotime($data->date))); ?></span>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="title"> <a href="<?php echo e(route('frontend.events.single',$data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                        <div class="description"><?php echo e(strip_tags(Str::words(strip_tags($data->content),20))); ?></div>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> <?php echo e($data->venue_location); ?></li>
                            <li><i class="far fa-clock"></i> <?php echo e($data->time); ?></li>
                        </ul>
                    </div>
                </div>
                <?php ($a == 2) ? $a = 0 : $a++; ?> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
<div class="logistic-testimonial-area padding-top-115 padding-bottom-120"
<?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_11_testimonial_area_background_image',$static_field_data)); ?>

>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)); ?></h2>
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
                            <div class="logistic-single-testimonial-item political-home">
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

<?php if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data,$static_field_data))): ?>
    <div class="const-news-area padding-bottom-120 industry-section-bg padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 political-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_new_area_subtitle',$static_field_data,$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_new_area_title',$static_field_data)); ?></h2>
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
                                <div class="single-portfolio-blog-grid political-home">
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
                                        <p class="excerpt"><?php echo e(strip_tags($data->excerpt)); ?></p>
                                        <a class="readmore" href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_new_area_button_text',$static_field_data)); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
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


<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/home-pages/home-11.blade.php ENDPATH**/ ?>