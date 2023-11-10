<?php echo $__env->make('frontend.partials.homesupportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
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

<div class="header-slider-wrapper course-home p"
        <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_17_header_area_background_image',$static_field_data)); ?>

>
    <div class="right-image-wrap">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_17_header_area_right_image',$static_field_data)); ?>

    </div>
    <div class="header-area course-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header-inner">
                        <h1 class="title"><?php echo e(filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_title',$static_field_data)); ?></h1>
                        <div class="description"><?php echo filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_description',$static_field_data); ?></div>
                        <div class="btn-wrapper margin-top-30">
                            <?php if(!empty(filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('home_page_17_header_area_button_url',$static_field_data)); ?>"
                                   class="btn-dagency"><?php echo e(filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data)); ?>

                                    <i class="<?php echo e(filter_static_option_value('home_page_17_header_area_button_icon',$static_field_data)); ?>"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(!empty(filter_static_option_value('home_page_course_category_section_status',$static_field_data))): ?>
<div class="category-slider-wrap padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class=" global-carousel-init course-category-carousel"
                     data-loop="true"
                     data-desktopitem="5"
                     data-mobileitem="2"
                     data-tabletitem="3"
                     data-autoplay="true"
                     data-margin="40",
                     data-dots="true",
                     data-nav="true"
                >
                    <?php $a=1; ?>
                    <?php $__currentLoopData = $all_courses_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-course-category-item">
                            <a href="<?php echo e(route('frontend.course.category',[Str::slug($data->lang_front->title ?? '','-',$data->lang_front->lang ?? ''),$data->id])); ?>">
                            <div class="icon bg-<?php echo e($a); ?>"
                            style="background-image: url(<?php echo e(asset('assets/frontend/img/icon/course-'.$a.'.svg')); ?>)"
                            >
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            </a>
                            <div class="content">
                                <a href="<?php echo e(route('frontend.course.category',[Str::slug($data->lang_front->title ?? '','-',$data->lang_front->lang ?? ''),$data->id])); ?>">
                                <h4 class="title"><?php echo e($data->lang_front->title ?? __('Untitled')); ?></h4>
                                </a>
                                <span class="count"><?php echo e($data->course->count() ?? 0); ?> <?php echo e(__('Courses')); ?></span>
                            </div>
                        </div>
                        <?php if($a == 6){ $a=1;}else{$a++;} ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_our_speciality_section_status',$static_field_data))): ?>
<div class="our-specialities-area padding-top-60 padding-bottom-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title course-home margin-bottom-80">
                    <h2 class="title"><?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_specialities_area_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                $all_icon_fields =  filter_static_option_value('course_home_page_specialities_item_icon',$static_field_data);
                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false]) : [];
                $all_title_fields = filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_specialities_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
                $all_description_fields = filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_specialities_item_description',$static_field_data);
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $all_url_fields = filter_static_option_value('course_home_page_specialities_item_url',$static_field_data);
                $all_url_fields = !empty($all_url_fields) ? unserialize($all_url_fields,['class' => false]) : [];
           $a = 1;
            ?>
            <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3">
                    <div class="single-specialities-item bg-color-<?php echo e($a); ?>">
                        <div class="icon"><i class="<?php echo e($icon); ?>"></i></div>
                        <div class="content">
                            <h4 class="title"><a href="<?php echo e($all_url_fields[$index] ?? ''); ?>"><?php echo e($all_title_fields[$index] ?? ''); ?></a></h4>
                            <div class="description"><?php echo e($all_description_fields[$index] ?? ''); ?></div>
                        </div>
                    </div>
                </div>
                <?php $a < 5 ? $a++ : $a=1;  ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_featured_courses_section_status',$static_field_data))): ?>
<div class="latest-courses-area course-section-bg padding-bottom-80 padding-top-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title course-home margin-bottom-80">
                    <h2 class="title"><?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_featured_course_area_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="recent-course-area global-carousel-init"
                     data-loop="true"
                     data-desktopitem="3"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-autoplay="true"
                     data-nav="true"
                     data-margin="30"
                     data-stagePadding="10"
                >
                    <?php $a=1; ?>
                    <?php $__currentLoopData = $featured_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="course-single-grid-item">
                            <div class="thumb">
                                <a href="<?php echo e(route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])); ?>">
                                    <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                </a>
                                <div class="price-wrap">
                                    <?php echo e(amount_with_currency_symbol($data->price)); ?>

                                    <del><?php echo e(amount_with_currency_symbol($data->sale_price)); ?></del>
                                </div>
                                <div class="cat">
                                    <a class="bg-<?php echo e($a); ?>" href="<?php echo e(route('frontend.course.category',[Str::slug(optional(optional($data->category)->lang_front)->title ?? '','-',optional(optional($data->category)->lang_front)->lang),optional($data->category)->id])); ?>"><?php echo e(optional(optional($data->category)->lang_front)->title); ?></a>
                                </div>
                            </div>
                            <div class="content">
                                <?php if(count($data->reviews) > 0): ?>
                                    <div class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating" style="width: <?php echo e(get_course_ratings_avg_by_id($data->id) / 5 * 100); ?>%"></span>
                                        </div>
                                        <p><span class="total-ratings">(<?php echo e(count($data->reviews)); ?>)</span></p>
                                    </div>
                                <?php endif; ?>
                                <h3 class="title"><a href="<?php echo e(route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])); ?>"><?php echo e(Str::words($data->lang_front->title ?? '',6,'..')); ?></a></h3>
                                <div class="instructor-wrap"><span><?php echo e(__('By')); ?></span> <a href="<?php echo e(route('frontend.course.instructor',[Str::slug($data->instructor->name ?? ''),$data->instructor->id])); ?>"><?php echo e($data->instructor->name); ?></a></div>
                                <div class="description">
                                    <?php echo Str::words(strip_tags($data->lang_front->description ?? ''),15); ?>

                                </div>
                                <div class="footer-part">
                                    <span><i class="fas fa-users"></i> <?php echo e($data->enrolled_student); ?> <?php echo e(__('Enrolled')); ?></span>
                                    <span><i class="fas fa-clock"></i> <?php echo e($data->duration); ?> <?php echo e($data->duration_type); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if($a == 4){ $a=1;}else{$a++;} ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_video_section_status',$static_field_data))): ?>
    <div class="logistic-video-area-wrap padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logistic-video-wrap">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('course_home_page_video_section_background_image',$static_field_data),'','full'); ?>

                        <a href="<?php echo e(filter_static_option_value('course_home_page_video_section_video_url',$static_field_data)); ?>" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
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
    <div class="cagency-counterup-area course-bg padding-bottom-120" style="background-image: url(<?php echo e(asset('assets/frontend/img/shape/course-cta-shape.png')); ?>)">
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
<?php if(!empty(filter_static_option_value('home_page_all_courses_section_status',$static_field_data))): ?>
<div class="all-courses-area padding-top-110 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-between ">
           <div class="col-lg-8">
               <div class="section-title course-home margin-bottom-80">
                   <h2 class="title"><?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_all_course_area_title',$static_field_data)); ?></h2>
               </div>
           </div>
            <div class="col-lg-4">
                <div class="btn-wrapper desktop-right course-home">
                    <a href="<?php echo e(route('frontend.course')); ?>" class="achor-btn"><?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_all_course_area_button_text',$static_field_data)); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $a=1; ?>
            <?php $__currentLoopData = $latest_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="course-single-grid-item">
                        <div class="thumb">
                            <a href="<?php echo e(route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])); ?>">
                                <?php echo render_image_markup_by_attachment_id($data->image); ?>

                            </a>
                            <div class="price-wrap">
                                <?php echo e(amount_with_currency_symbol($data->price)); ?>

                                <del><?php echo e(amount_with_currency_symbol($data->sale_price)); ?></del>
                            </div>
                            <div class="cat">
                                <a class="bg-<?php echo e($a); ?>" href="<?php echo e(route('frontend.course.category',[Str::slug(optional(optional($data->category)->lang_front)->title ,'-',optional(optional($data->category)->lang_front)->lang),optional($data->category)->id])); ?>"><?php echo e(optional(optional($data->category)->lang_front)->title); ?></a>
                            </div>
                        </div>
                        <div class="content">
                            <?php if(count($data->reviews) > 0): ?>
                                <div class="rating-wrap">
                                    <div class="ratings">
                                        <span class="hide-rating"></span>
                                        <span class="show-rating" style="width: <?php echo e(get_course_ratings_avg_by_id($data->id) / 5 * 100); ?>%"></span>
                                    </div>
                                    <p><span class="total-ratings">(<?php echo e(count($data->reviews)); ?>)</span></p>
                                </div>
                            <?php endif; ?>
                            <h3 class="title"><a href="<?php echo e(route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])); ?>"><?php echo e(Str::words($data->lang_front->title ?? '',6,'..')); ?></a></h3>
                            <div class="instructor-wrap"><span><?php echo e(__('By')); ?></span> <a href="<?php echo e(route('frontend.course.instructor',[Str::slug($data->instructor->name),$data->instructor->id])); ?>"><?php echo e($data->instructor->name); ?></a></div>
                            <div class="description">
                                <?php echo Str::words(strip_tags($data->lang_front->description ?? ''),15); ?>

                            </div>
                            <div class="footer-part">
                                <span><i class="fas fa-users"></i> <?php echo e($data->enrolled_student); ?> <?php echo e(__('Enrolled')); ?></span>
                                <span><i class="fas fa-clock"></i> <?php echo e($data->duration); ?> <?php echo e($data->duration_type); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php if($a == 4){ $a=1;}else{$a++;} ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
    <div class="cleaning-home-testimonial-area padding-top-120 padding-bottom-120 course-section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title margin-bottom-80 course-home">
                        <h2 class="title"><?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_testimonial_area_title',$static_field_data)); ?></h2>
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
                                <div class="const-single-testimonial-item course-home">
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
<?php if(!empty(filter_static_option_value('home_page_event_section_status',$static_field_data))): ?>
    <div class="course-event-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title margin-bottom-80 course-home">
                        <h2 class="title"><?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_event_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="event-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="0"
                        >
                            <?php $__currentLoopData = $all_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-events-list-item course-home">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                    </div>
                                    <div class="content-area">
                                        <div class="top-part">
                                            <div class="time-wrap">
                                                <span class="date"><?php echo e(date('d',strtotime($data->date))); ?></span>
                                                <span class="month"><?php echo e(date('M',strtotime($data->date))); ?></span>
                                            </div>
                                            <div class="title-wrap">
                                                <a href="<?php echo e(route('frontend.events.single',$data->slug)); ?>"><h4 class="title"><?php echo e($data->title); ?></h4></a>
                                            </div>
                                        </div>
                                        <span class="location d-block"><i class="fas fa-map-marker-alt"></i> <?php echo e($data->venue_location); ?></span>
                                        <p><?php echo e(strip_tags(Str::words(str_replace('&nbsp;',' ',$data->content),20))); ?></p>
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
    <div class="course-cta-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="course-inner-area-wrap">
                        <div class="left-content-wrap">
                            <h2 class="title"><?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)); ?></h2>
                        </div>
                        <?php if(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data)): ?>
                        <div class="right-content-wrap">
                            <div class="btn-wrapper">
                                <a href="<?php echo e(filter_static_option_value('course_home_page_cta_area_button_url',$static_field_data)); ?>" class="btn-dagency"> <?php echo e(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)); ?> <i class="<?php echo e(filter_static_option_value('course_home_page_cta_section_button_icon',$static_field_data)); ?>"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/home-pages/home-17.blade.php ENDPATH**/ ?>