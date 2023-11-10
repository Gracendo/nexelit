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
    <div class="header-slider-one global-carousel-init"
         data-loop="true"
         data-desktopitem="1"
         data-mobileitem="1"
         data-tabletitem="1"
         data-nav="true"
         data-autoplay="true"
         data-margin="0"
    >
        <?php
            $all_bg_image_fields =  filter_static_option_value('home_page_10_header_section_bg_image',$static_field_data);
            $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields,['class' => false]) : [];
            $all_button_one_url_fields =  filter_static_option_value('home_page_10_header_section_button_one_url',$static_field_data);
            $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields,['class' => false]) : [];
            $all_button_two_url_fields =  filter_static_option_value('home_page_10_header_section_button_two_url',$static_field_data);
            $all_button_two_url_fields = !empty($all_button_two_url_fields) ? unserialize($all_button_two_url_fields,['class' => false]) : [];
            $all_description_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
            $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
            $all_btn_one_text_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
            $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields,['class' => false]) : [];
            $all_btn_two_text_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_button_two_text',$static_field_data);
            $all_btn_two_text_fields = !empty($all_btn_two_text_fields) ? unserialize($all_btn_two_text_fields,['class' => false]) : [];
            $all_title_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
            $all_subtitle_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_subtitle',$static_field_data);
            $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];
        ?>
        <?php $__currentLoopData = $all_bg_image_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="header-area lawyer-home"
                <?php echo render_background_image_markup_by_attachment_id($image); ?>

        >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="header-inner">
                            <span class="subtitle"><?php echo e($all_subtitle_fields[$index] ?? ''); ?></span>
                            <h1 class="title"><?php echo e($all_title_fields[$index] ?? ''); ?></h1>
                            <p class="description"><?php echo e($all_description_fields[$index] ?? ''); ?></p>
                            <div class="btn-wrapper margint-top-30">
                                <?php if(!empty($all_button_one_url_fields[$index])): ?>
                                    <a href="<?php echo e($all_button_one_url_fields[$index] ?? ''); ?>" class="boxed-btn laywer"><?php echo e($all_btn_one_text_fields[$index] ?? ''); ?></a>
                                <?php endif; ?>
                                    <?php if(!empty($all_button_two_url_fields[$index])): ?>
                                        <a href="<?php echo e($all_button_two_url_fields[$index] ?? ''); ?>" class="boxed-btn laywer blank"><?php echo e($all_btn_two_text_fields[$index] ?? ''); ?></a>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php if(!empty(filter_static_option_value('home_page_key_feature_section_status',$static_field_data))): ?>
<div class="header-button-area">
    <div class="container">
        <div class="row">
            <?php
                $all_button_one_icon_fields =  filter_static_option_value('home_page_10_key_features_section_icon',$static_field_data);
                $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields,['class' => false]) : [];
                $all_description_fields = get_static_option('home_page_10_'.$user_select_lang_slug.'_key_feeatures_item_description',$static_field_data);
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $all_title_fields = get_static_option('home_page_10_'.$user_select_lang_slug.'_key_features_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
            ?>
            <?php $__currentLoopData = $all_button_one_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="header-bottom-item-lawyer">
                    <div class="icon">
                        <i class="<?php echo e($icon); ?>"></i>
                    </div>
                    <h3 class="title"><?php echo e($all_title_fields[$index] ?? ''); ?></h3>
                    <p><?php echo e($all_description_fields[$index] ?? ''); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data))): ?>
    <div class="lawyer-about-area lawyer-home padding-top-115 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('lawyer_about_section_left_top_image',$static_field_data)); ?>

                        <div class="shape">
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('lawyer_about_section_left_bottom_image',$static_field_data)); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <span class="subtitle"><?php echo e(filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                        <div class="description"><?php echo filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_description',$static_field_data); ?></div>
                        <div class="btn-wrapper">
                            <?php if(!empty(filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('lawyer_about_section_button_url',$static_field_data)); ?>"
                                   class="boxed-btn lawyer-home">
                                    <?php echo e(filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
    <div class="lawyer-what-we-offer-area padding-top-120 industry-section-bg padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_service_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="construction-single-what-we-cover-item lawyer-home margin-bottom-30">
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
                                   class="readmore"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_service_area_readmore_text',$static_field_data)); ?>

                                    <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if(!empty(filter_static_option_value('home_page_appointment_section_status',$static_field_data))): ?>
    <div class="const-team-member-area padding-top-120 padding-bottom-120 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_appointment_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_appointment_section_title',$static_field_data)); ?></h2>
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
                                <div class="appointment-single-item lawyyer-home">
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
                                            <span class="location"><i class="fas fa-map-marker-alt"></i><?php echo e($data->lang_front->location); ?></span>
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


<?php if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data))): ?>
    <div class="logistic-project-area">
        <div class="case-studies-masonry-wrapper global-carousel-init"
             data-loop="true"
             data-desktopitem="4"
             data-mobileitem="1"
             data-tabletitem="2"
             data-nav="false"
             data-dots="true"
             data-autoplay="true"
             data-margin="0"
        >
            <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="const-single-case-study-style-02 lawyer-home">
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

<?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
    <div class="lawyer-counterup-area padding-top-115 padding-bottom-115"
    <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_10_counterup_section_background_image',$static_field_data)); ?>

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



<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
    <div class="const-testimonial-area padding-top-115 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="testimonial-carousel-area margin-top-10 logistic-dots lawyer-home">
                        <div class="global-carousel-init"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="0"
                        >
                            <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="lawyer-single-testimonial-item">
                                    <div class="thumb ">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    </div>
                                    <div class="content">
                                        <p class="description "><?php echo e($data->description); ?></p>
                                    </div>
                                    <div class="author-details ">
                                        <i class="fas fa-quote-left"></i>
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
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_new_area_subtitle',$static_field_data,$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_new_area_title',$static_field_data)); ?></h2>
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
                                <div class="single-portfolio-blog-grid lawyer-home">
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

<?php if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data))): ?>
<section class="lawyer-call-to-action padding-top-120 padding-bottom-120"
<?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_10_cta_area_background_image',$static_field_data)); ?>

>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="inner-wrap">
                    <h3 class="title"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)); ?></h3>
                    <p><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_description',$static_field_data)); ?></p>
                    <?php if(!empty(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data))): ?>
                    <div class="btn-wrapper">
                        <a href="<?php echo e(filter_static_option_value('home_page_10_cta_area_button_url',$static_field_data)); ?>" class="boxed-btn lawyer-home"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)); ?></a>
                    </div>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_contact_section_status',$static_field_data))): ?>
<div class="lawyer-contact-area padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-contnet-wrap">
                    <ul class="lawyer-contact-list">
                        <?php $__currentLoopData = $all_contact_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="lawyer-contact-item">
                            <div class="icon">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            <div class="content">
                                <span class="title"><?php echo e($data->title); ?></span>
                                <?php
                                    $info_details = !empty($data->description) ? explode("\n",$data->description) : [];
                                ?>
                                <?php $__currentLoopData = $info_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="details"><?php echo e($item); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-wrap">
                <h3 class="title"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_contact_area_title',$static_field_data)); ?></h3>
                <form action="<?php echo e(route('frontend.get.touch')); ?>" id="get_in_touch_form" method="post" enctype="multipart/form-data"
                            class="contact-page-form">
                        <div class="error-message"></div>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="captcha_token" id="gcaptcha_token"/>
                                <?php echo render_form_field_for_frontend(filter_static_option_value('get_in_touch_form_fields',$static_field_data)); ?>

                        
                        <div class="btn-wrapper">
                            <button type="submit" id="get_in_touch_submit_btn"
                                    class="boxed-btn lawyer-page"><?php echo e(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_contact_area_button_title',$static_field_data)); ?></button>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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
                        console.log(data);
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
<?php $__env->stopSection(); ?>
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/home-pages/home-10.blade.php ENDPATH**/ ?>