<?php echo $__env->make('frontend.partials.homesupportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant',$static_field_data);
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

<div class="cagency-header-static">
        <div class="header-area">
            <div class="shape-image shape-01">
                <img src="<?php echo e(asset('assets/frontend/img/shape/08.png')); ?>" alt="">
            </div>
            <div class="shape-image shape-02">
                <img src="<?php echo e(asset('assets/frontend/img/shape/09.png')); ?>" alt="">
            </div>
            <div class="shape-image shape-03">
                <img src="<?php echo e(asset('assets/frontend/img/shape/10.png')); ?>" alt="">
            </div>

            <div class="right-image">
                <?php echo render_image_markup_by_attachment_id(filter_static_option_value('cagency_header_section_right_image',$static_field_data)); ?>

                <div class="shape-04">
                    <img src="<?php echo e(asset('assets/frontend/img/shape/11.png')); ?>" alt="">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-10">
                        <div class="header-inner">
                             <h1 class="title"><?php echo e(filter_static_option_value('cagency_header_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h1>
                             <div class="description"><?php echo filter_static_option_value('cagency_header_section_'.$user_select_lang_slug.'_description',$static_field_data); ?></div>
                            <?php if(!empty(filter_static_option_value('cagency_header_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data))): ?>
                                <div class="btn-wrapper margin-top-30">
                                    <a href="<?php echo e(filter_static_option_value('cagency_header_section_button_one_url',$static_field_data)); ?>" class="cagency-btn"><?php echo e(filter_static_option_value('cagency_header_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)); ?> <i class="<?php echo e(filter_static_option_value('cagency_header_section_button_one_icon',$static_field_data)); ?>"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
<div class="logistics-what-we-offer-area padding-top-115 padding-bottom-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center padding-bottom-100">
                    <span class="subtitle"><?php echo e(filter_static_option_value('cagency_what_we_offer_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('cagency_what_we_offer_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $a = 1; ?>
            <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="cagency-single-what-we-cover-item margin-bottom-30">
                        <?php if($data->icon_type == 'icon' || $data->icon_type == ''): ?>
                            <div class="icon style-<?php echo e($a); ?>">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                        <?php else: ?>
                            <div class="img-icon style-0<?php echo e($a); ?>">
                                <?php echo render_image_markup_by_attachment_id($data->img_icon); ?>

                            </div>
                        <?php endif; ?>
                        <div class="content">
                            <h4 class="title"><a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                            <p><?php echo e($data->excerpt); ?></p>
                            <a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>" class="readmore"><?php echo e(filter_static_option_value('logistic_what_we_offer_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
               <?php $a == 6 ? $a =1 : $a++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_video_section_status',$static_field_data))): ?>
<div class="logistic-video-area-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logistic-video-wrap">
                    <?php echo render_image_markup_by_attachment_id(filter_static_option_value('creative_agency_video_section_background_image',$static_field_data),'','full'); ?>

                    <a href="<?php echo e(filter_static_option_value('creative_agency_video_section_video_url',$static_field_data)); ?>" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                    <div class="shape">
                        <img src="<?php echo e(asset('assets/frontend/img/shape/11.png')); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
<div class="cagency-counterup-area bg-overlay padding-bottom-120">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6">
                    <div class="cagency-counterup-item">
                        <div class="number style-<?php echo e($loop->index + 1); ?>">
                            <div class="count-wrap"><span class="count-num"><?php echo e($data->number); ?></span><?php echo e($data->extra_text); ?></div>
                        </div>
                        <div class="content">
                            <h4 class="title"><?php echo e($data->title); ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('home_page_work_process_section_status'))): ?>
<div class="creative-agency-work-process-area padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('cagency_work_process_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('cagency_work_process_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="cagency-work-process-list">
                    <?php
                        $all_icon_fields =  filter_static_option_value('cagency_work_process_section_item_number',$static_field_data);
                        $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                        $all_title_fields = filter_static_option_value('cagency_work_process_section_item_'.$user_select_lang_slug.'_title',$static_field_data);
                        $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                    ?>
                    <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="single-work-process-item">
                        <div class="num-wrap style-<?php echo e($loop->index + 1); ?>">
                            <span class="number"><?php echo e($number); ?></span>
                        </div>
                        <h4 class="title"><?php echo e($all_title_fields[$loop->index] ?? ''); ?></h4>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data))): ?>
<div class="creative-agency-project-area padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('cagency_our_portfolio_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('cagency_our_portfolio_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="case-studies-masonry-wrapper">
                    <ul class="case-studies-menu style-01">
                        <li class="active" data-filter="*"><?php echo e(__('All')); ?></li>
                        <?php $__currentLoopData = $all_work_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li data-filter=".<?php echo e(Str::slug($data->name)); ?>"><?php echo e($data->name); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="case-studies-masonry">
                        <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-4 col-sm-6 masonry-item <?php echo e(get_work_category_by_id($data->id,'slug')); ?>">
                                <div class="single-case-studies-item">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    </div>
                                    <div class="cart-icon">
                                        <h4 class="title"><a href="<?php echo e(route('frontend.work.single',$data->slug)); ?>"> <?php echo e($data->title); ?></a></h4>
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
    <div class="creative-agency-call-to-action padding-100">
        <div class="shape shape-01">
            <img src="<?php echo e(asset('assets/frontend/img/shape/01.png')); ?>" alt="">
        </div>
        <div class="shape shape-02">
            <img src="<?php echo e(asset('assets/frontend/img/shape/02.png')); ?>" alt="">
        </div>
        <div class="shape shape-03">
            <img src="<?php echo e(asset('assets/frontend/img/shape/03.png')); ?>" alt="">
        </div>
        <div class="shape shape-04">
            <img src="<?php echo e(asset('assets/frontend/img/shape/04.png')); ?>" alt="">
        </div>
        <div class="shape shape-05">
            <img src="<?php echo e(asset('assets/frontend/img/shape/05.png')); ?>" alt="">
        </div>
        <div class="right-image-wrap">
            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('cagency_cta_section_right_image',$static_field_data)); ?>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-10">
                    <div class="cagency-cta-area-inner">
                        <h2 class="title"><?php echo e(filter_static_option_value('cagency_cta_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                        <p class="description"><?php echo e(filter_static_option_value('cagency_cta_section_'.$user_select_lang_slug.'_description',$static_field_data)); ?></p>
                        <div class="btn-wrapper margin-top-30">
                            <a href="<?php echo e(filter_static_option_value('cagency_cta_section_button_url',$static_field_data)); ?>" class="cagency-btn"><?php echo e(filter_static_option_value('cagency_cta_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?> <i class="<?php echo e(filter_static_option_value('cagency_cta_section_button_icon',$static_field_data)); ?>"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
<div class="creative-agency-testimonial-area padding-top-115 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('cagency_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('cagency_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-carousel-area margin-top-10 ">
                    <div class="global-carousel-init logistic-dots"
                         data-loop="true"
                         data-desktopitem="3"
                         data-mobileitem="1"
                         data-tabletitem="2"
                         data-dots="true"
                         data-autoplay="true"
                         data-margin="30"
                    >
                        <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cagency-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description "><?php echo e($data->description); ?></p>
                                </div>
                               <div class="author-details">
                                   <div class="thumb ">
                                       <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                   </div>
                                   <div class="content">
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
<?php if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data))): ?>
<div class="creative-agency-news-area padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('cagency_news_area_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('cagency_news_area_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-grid-carosel-wrapper">
                    <div class="global-carousel-init logistic-dots"
                         data-loop="true"
                         data-desktopitem="3"
                         data-mobileitem="1"
                         data-tabletitem="2"
                         data-dots="true"
                         data-autoplay="true"
                         data-margin="30"
                    >
                        <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-portfolio-blog-grid creative-agency-page">
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image,'grid'); ?>

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
                                    <a class="readmore" href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?></a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/home-pages/home-08.blade.php ENDPATH**/ ?>