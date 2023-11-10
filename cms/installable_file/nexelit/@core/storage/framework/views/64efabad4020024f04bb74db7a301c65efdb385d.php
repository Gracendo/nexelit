<?php echo $__env->make('frontend.partials.homesupportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
?>
<div class="header-style-02  header-variant-<?php echo e($home_page_variant); ?>">
    <nav class="navbar navbar-area nav-absolute navbar-expand-lg nav-style-01">
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

<div class="portfolio-home-header-area">
    <div class="shape-01 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/01.png')); ?>" alt="">
    </div>
    <div class="shape-02 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/02.png')); ?>" alt="">
    </div>
    <div class="shape-03 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/03.png')); ?>" alt="">
    </div>
    <div class="shape-04 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/04.png')); ?>" alt="">
    </div>
    <div class="shape-05 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/05.png')); ?>" alt="">
    </div>
    <div class="right-image">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('portfolio_home_page_right_image',$static_field_data)); ?>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="header-inner">
                    <span class="subtitle"><?php echo e(filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h1 class="title"><?php echo e(filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h1>
                    <h6 class="profession"><?php echo e(filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_profession',$static_field_data)); ?></h6>
                    <div class="description"><?php echo filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_description',$static_field_data); ?></div>
                    <div class="btn-wrapper margin-top-40">
                        <a href="<?php echo e(filter_static_option_value('portfolio_home_page_button_url',$static_field_data)); ?>"
                           class="portfolio-btn"><?php echo e(filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?>

                            <i class="fas fa-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-and-coutnerup-area dark-section-bg-two">
    <?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
    <div class="counterup-area padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-counterup-03">
                            <div class="number"><?php echo e($data->number); ?><?php echo e($data->extra_text); ?></div>
                            <h4 class="title"><?php echo e($data->title); ?></h4>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data))): ?>
    <div class="portfolio-about-us-section padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <div class="img-wrapper">
                            <div class="shape-06">
                                <img src="<?php echo e(asset('assets/frontend/img/shape/06.png')); ?>" alt="">
                            </div>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('portfolio_about_section_left_image',$static_field_data)); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <span class="subtitle"><?php echo e(filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h3 class="title"><?php echo e(filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h3>
                        <div class="description">
                            <?php echo filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_description',$static_field_data); ?>

                        </div>
                        <ul class="about-info-list">
                            <?php
                                $all_icon_fields =  filter_static_option_value('home_page_05_about_section_icon_box_icon',$static_field_data);
                                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                                $all_title_fields = filter_static_option_value('home_page_05_'.$user_select_lang_slug.'_about_section_icon_box_title',$static_field_data);
                                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            ?>
                            <?php if(!empty($all_icon_fields)): ?>
                                <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <i class="<?php echo e($icon); ?>"></i> <?php echo e(isset($all_title_fields[$index]) ? $all_title_fields[$index] : ''); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                        <div class="button-wrap margin-top-40">
                            <a href="<?php echo e(filter_static_option_value('portfolio_about_section_button_one_url',$static_field_data)); ?>"
                               class="portfolio-btn"><?php echo e(filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)); ?>

                                <i class="<?php echo e(filter_static_option_value('portfolio_about_section_button_one_icon',$static_field_data)); ?>"></i></a>
                            <a href="<?php echo e(filter_static_option_value('portfolio_about_section_button_two_url',$static_field_data)); ?>"
                               class="portfolio-btn blank"><?php echo e(filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_button_two_text',$static_field_data)); ?>

                                <i class="<?php echo e(filter_static_option_value('portfolio_about_section_button_two_icon',$static_field_data)); ?>"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if(!empty(filter_static_option_value('home_page_expertice_section_status',$static_field_data))): ?>
<div class="expertice-area dark-section-bg-three padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('portfolio_expertice_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('portfolio_expertice_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                $all_icon_fields =  filter_static_option_value('home_page_05_experties_section_skill_box_number',$static_field_data);
                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                $all_title_fields = filter_static_option_value('home_page_05_'.$user_select_lang_slug.'_experties_section_skill_box_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                $all_subtitle_fields = filter_static_option_value('home_page_05_'.$user_select_lang_slug.'_experties_section_skill_box_subtitle',$static_field_data);
                $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields) : [];
            ?>
            <?php if(!empty($all_icon_fields)): ?>
                <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-expertice-area">
                            <span class="number"><?php echo e($icon); ?>%</span>
                            <h4 class="title"><?php echo e(isset($all_title_fields[$index]) ? $all_title_fields[$index] : ''); ?></h4>
                            <span class="category"><?php echo e(isset($all_subtitle_fields[$index]) ? $all_subtitle_fields[$index] : ''); ?></span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
<div class="what-we-offer-area dark-section-bg-two padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('portfolio_what_we_offer_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('portfolio_what_we_offer_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6">
                <div class="single-we-offer-item">
                    <?php if($data->icon_type == 'icon' || $data->icon_type == ''): ?>
                        <div class="icon">
                            <i class="<?php echo e($data->icon); ?>"></i>
                        </div>
                    <?php else: ?>
                        <div class="img-icon">
                            <?php echo render_image_markup_by_attachment_id($data->img_icon); ?>

                        </div>
                    <?php endif; ?>
                    <div class="content-wrap">
                        <h4 class="title"><a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                        <p><?php echo e($data->excerpt); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data))): ?>
<div class="what-we-offer-area dark-section-bg-three padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('portfolio_recent_work_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('portfolio_recent_work_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="case-studies-masonry-wrapper">
                    <ul class="case-studies-menu white">
                        <li class="active" data-filter="*"><?php echo e(__('All')); ?></li>
                        <?php $__currentLoopData = $all_work_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li data-filter=".<?php echo e(Str::slug($data->name)); ?>"><?php echo e($data->name); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="case-studies-masonry">
                        <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-4 col-sm-6 masonry-item <?php echo e(get_work_category_by_id($data->id,'slug')); ?>">
                                <div class="single-case-studies-item portfolio-home margin-bottom-30">
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
                <div class="btn-wrapper text-center margin-top-40">
                    <a href="<?php echo e(route('frontend.work')); ?>" class="portfolio-btn"><?php echo e(filter_static_option_value('portfolio_recent_work_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data))): ?>
<div class="portfolio-cta-area dark-section-bg-two">
    <div class="shape-01 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/01.png')); ?>" alt="">
    </div>
    <div class="shape-02 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/02.png')); ?>" alt="">
    </div>
    <div class="shape-03 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/03.png')); ?>" alt="">
    </div>
    <div class="shape-04 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/04.png')); ?>" alt="">
    </div>
    <div class="shape-05 shape">
        <img src="<?php echo e(asset('assets/frontend/img/shape/05.png')); ?>" alt="">
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-8">
                <div class="left-content-wrap">
                    <h4 class="title"><?php echo e(filter_static_option_value('portfolio_cta_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h4>
                    <p class="description"><?php echo e(filter_static_option_value('portfolio_cta_section_'.$user_select_lang_slug.'_description',$static_field_data)); ?></p>
                    <div class="btn-wrapper">
                        <a href="<?php echo e(filter_static_option_value('portfolio_cta_section_button_url',$static_field_data)); ?>" class="portfolio-btn"><?php echo e(filter_static_option_value('portfolio_cta_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?> <i class="<?php echo e(filter_static_option_value('portfolio_cta_section_button_icon',$static_field_data)); ?>"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content-wrap">
                    <div class="img-wrap">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('portfolio_cta_section_right_image',$static_field_data)); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
<div class="portfolio-testimonial-area dark-section-bg-three padding-top-115 padding-bottom-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('portfolio_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('portfolio_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12 ">
                <div class="testimonial-carousel-area margin-top-10 ">
                        <div class=" pcarousel-dots global-carousel-init"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                        <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-portfolio-testimonial-item ">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description "><?php echo e($data->description); ?></p>
                                </div>
                                <div class="author-details ">
                                    <div class="thumb ">
                                        <?php echo render_image_markup_by_attachment_id($data->image,'','thumb'); ?>

                                    </div>
                                    <div class="author-meta ">
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
<div class="portfolio-news-area dark-section-bg-two padding-top-115 padding-bottom-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle"><?php echo e(filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-grid-carosel-wrapper">
                        <div class=" pcarousel-dots global-carousel-init"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                        <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-portfolio-blog-grid">
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
<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/home-pages/home-05.blade.php ENDPATH**/ ?>