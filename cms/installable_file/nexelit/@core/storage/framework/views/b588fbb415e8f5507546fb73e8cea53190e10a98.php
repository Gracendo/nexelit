<?php
    $home_page_variant =$home_page ?? get_static_option('home_page_variant');
?>
<div class="construction-support-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="support-inner">
                    <div class="left-content-wrap">
                        <?php
                            $all_icon_fields =  filter_static_option_value('home_page_07_topbar_section_info_item_icon',$static_field_data);
                            $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_title',$static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            $all_details_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_details',$static_field_data);
                            $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                        ?>
                        <ul class="construction-info-list">
                            <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="construction-single-info-list-item">
                                    <div class="icon">
                                        <i class="<?php echo e($icon); ?>"></i>
                                    </div>
                                    <div class="content">
                                        <span class="subtitle"><?php echo e($all_title_fields[$loop->index] ?? ''); ?></span>
                                        <h5 class="title"><?php echo e($all_details_fields[$loop->index] ?? ''); ?></h5>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="right-content-wrap">
                        <ul>
                            <?php if(auth()->check()): ?>
                                <?php
                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                ?>
                                <li><a href="<?php echo e($route); ?>"><?php echo e(__('Dashboard')); ?></a> <span>/</span>
                                    <a href="<?php echo e(route('user.logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>
                                    <form id="userlogout-form" action="<?php echo e(route('user.logout')); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            <?php else: ?>
                                <li><a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login')); ?></a> <span>/</span> <a
                                            href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Register')); ?></a></li>
                            <?php endif; ?>
                            <?php if(!empty(filter_static_option_value('language_select_option',$static_field_data))): ?>
                                <li>
                                    <select id="langchange">
                                        <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($user_select_lang_slug == $lang->slug): ?> selected
                                                    <?php endif; ?> value="<?php echo e($lang->slug); ?>"
                                                    class="lang-option"><?php echo e(explode('(',$lang->name)[0] ?? $lang->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty(filter_static_option_value('navbar_button',$static_field_data))): ?>
                                <li>
                                    <?php
                                        $custom_url = filter_static_option_value('navbar_button_custom_url_status',$static_field_data) ?? route('frontend.request.quote');
                                    ?>
                                    <div class="btn-wrapper">
                                        <a href="<?php echo e($custom_url); ?>" rel="canonical"
                                           <?php if(!empty(filter_static_option_value('navbar_button_custom_url_status',$static_field_data))): ?> target="_blank"
                                           <?php endif; ?> class="boxed-btn reverse-color"><?php echo e(filter_static_option_value('navbar_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?></a>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
    <div class="header-area style-04 header-bg-04 construction-home"
            <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('construction_header_section_bg_image',$static_field_data)); ?>

    >
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-inner construction-home">
                        <h1 class="title"><?php echo e(filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h1>
                        <p class="description"><?php echo e(filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_description',$static_field_data)); ?></p>
                        <div class="btn-wrapper">
                            <?php if(!empty(filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('construction_header_section_button_one_url',$static_field_data)); ?>"
                                   class="industry-btn construciton-home"><?php echo e(filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)); ?>

                                    <i class="<?php echo e(filter_static_option_value('construction_header_section_button_one_icon',$static_field_data)); ?>"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data))): ?>
    <div class="construction-about-area padding-top-115 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <div class="shape">
                            <img src="<?php echo e(asset('assets/frontend/img/shape/12.png')); ?>" alt="">
                        </div>
                        <div class="construction-video-wrap">
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('construction_about_section_left_image',$static_field_data)); ?>

                            <a class="video-play mfp-iframe"
                               href="<?php echo e(filter_static_option_value('construction_about_section_video_url',$static_field_data)); ?>"><i
                                        class="fas fa-play"></i></a>
                            <div class="experience-wrap">
                                <span class="year"><?php echo e(filter_static_option_value('construction_about_section_experience_year',$static_field_data)); ?></span>
                                <h5 class="title"><?php echo e(filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_experience_year_title',$static_field_data)); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <span class="subtitle"><?php echo e(filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                        <div class="description"><?php echo filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_description',$static_field_data); ?></div>
                        <div class="btn-wrapper">
                            <?php if(!empty(filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('construction_about_section_button_one_url',$static_field_data)); ?>"
                                   class="industry-btn const-home-color"><?php echo e(filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)); ?>

                                    <i class="<?php echo e(filter_static_option_value('construction_about_section_button_one_icon',$static_field_data)); ?>"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
    <div class="construction-counterup-area padding-top-115 padding-bottom-115">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="construction-counterup-item">
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
<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
    <div class="construction-what-we-offer-area padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle"><?php echo e(filter_static_option_value('construction_what_we_offer_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('construction_what_we_offer_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="construction-single-what-we-cover-item margin-bottom-30">
                            <?php if($data->icon_type == 'icon' || $data->icon_type == ''): ?>
                                <div class="icon">
                                    <i class="<?php echo e($data->icon); ?>"></i>
                                </div>
                            <?php else: ?>
                                <div class="img-icon">
                                    <?php echo render_image_markup_by_attachment_id($data->img_icon); ?>

                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h4 class="title"><a
                                            href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?></a>
                                </h4>
                                <p><?php echo e($data->excerpt); ?></p>
                                <a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"
                                   class="readmore"><?php echo e(filter_static_option_value('construction_what_we_offer_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?>

                                    <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_quote_faq_section_status',$static_field_data))): ?>
<div class="construction-quote-area padding-100"
<?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('construction_quote_section_bg_image',$static_field_data)); ?>

>
    <div class="right-image">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('construction_quote_section_right_image',$static_field_data)); ?>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title margin-bottom-60 white const-home-color">
                    <span class="subtitle"><?php echo e(filter_static_option_value('construction_quote_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('construction_quote_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                </div>
                <div class="construction-home-quote-form">
                    <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('backend.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form action="<?php echo e(route('frontend.quote.message')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                        <?php echo render_form_field_for_frontend(filter_static_option_value('quote_page_form_fields',$static_field_data)); ?>

                        <div class="btn-wrapper margin-top-40">
                            <button class="industry-btn const-home-color" type="submit"> <?php echo e(filter_static_option_value('construction_quote_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?> <i class="<?php echo e(filter_static_option_value('construction_quote_section__button_icon',$static_field_data)); ?>"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data))): ?>
    <div class="logistic-project-area padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title margin-bottom-60 const-home-color">
                        <span class="subtitle"><?php echo e(filter_static_option_value('construction_project_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('construction_project_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="construction-project-nav"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper construction-case-study-carousel global-carousel-init"
                    data-loop="true"
                    data-desktopitem="1"
                    data-mobileitem="1"
                    data-tabletitem="1"
                    data-nav="true"
                    data-dots="false"
                    data-autoplay="true"
                    data-navcontainer=".construction-project-nav"
                    data-stagepadding="200"
                    data-margin="30"
                    >
                        <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="const-single-case-study-style-02">
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
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_team_member_section_status',$static_field_data))): ?>
    <div class="const-team-member-area padding-top-115 padding-bottom-120 industry-section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle"><?php echo e(filter_static_option_value('construction_team_member_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('construction_team_member_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="team-member-carousel-area margin-top-10 ">
                        <div class="industry-member-carousel global-carousel-init logistic-dots const-page"
                             data-loop="true"
                             data-desktopitem="4"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-stagepadding="0"
                             data-margin="30"
                             >
                            <?php $__currentLoopData = $all_team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="const-team-single-item">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    </div>
                                    <div class="content">
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
                                                <li><a rel="canonical" href="<?php echo e($data->$value); ?>"><i class="<?php echo e($data->$key); ?>"></i></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
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

<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
    <div class="const-testimonial-area padding-top-115 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle"><?php echo e(filter_static_option_value('construction_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('construction_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10 logistic-dots const-page">
                        <div class="global-carousel-init"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="const-single-testimonial-item">
                                    <div class="content">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="description "><?php echo e($data->description); ?></p>
                                    </div>
                                    <div class="author-details ">
                                        <div class="thumb ">
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                        </div>
                                        <h4 class="title "><?php echo e($data->name); ?></h4>
                                        <span class="designation "><?php echo e($data->designation); ?></span>
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
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle"><?php echo e(filter_static_option_value('construction_news_area_section_'.$user_select_lang_slug.'_subtitle',$static_field_data,$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('construction_news_area_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-carosel-wrapper">
                            <div class="global-carousel-init logistic-dots const-page"
                                 data-loop="true"
                                 data-desktopitem="3"
                                 data-mobileitem="1"
                                 data-tabletitem="2"
                                 data-dots="true"
                                 data-autoplay="true"
                                 data-margin="30"
                            >
                            <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-portfolio-blog-grid const-page">
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
                                        <a class="readmore"
                                           href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?></a>
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
    <div class="client-section padding-bottom-70 padding-top-70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                            <div class="client-active-area global-carousel-init logistic-dots const-page"
                                 data-loop="true"
                                 data-desktopitem="5"
                                 data-mobileitem="1"
                                 data-tabletitem="3"
                                 data-dots="true"
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
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/home-pages/home-09.blade.php ENDPATH**/ ?>