<?php echo $__env->make('frontend.partials.homesupportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="header-slider-one global-carousel-init"
         data-loop="true"
         data-desktopitem="1"
         data-mobileitem="1"
         data-tabletitem="1"
         data-nav="true"
         data-autoplay="true"
         data-margin="0"
    >
    <?php $__currentLoopData = $all_header_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="header-area header-bg"
            <?php echo render_background_image_markup_by_attachment_id($data->image); ?>

        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-inner">
                            <?php if(!empty($data->subtitle)): ?>
                                <p class="subtitle"><?php echo e($data->subtitle); ?></p>
                            <?php endif; ?>
                            <?php if(!empty($data->title)): ?>
                                <h1 class="title"><?php echo e($data->title); ?></h1>
                            <?php endif; ?>
                            <?php if(!empty($data->description)): ?>
                                <p class="description"><?php echo e($data->description); ?></p>
                            <?php endif; ?>
                            <?php if(!empty($data->btn_01_status)): ?>
                                <div class="btn-wrapper  desktop-left padding-top-30">
                                    <a href="<?php echo e($data->btn_01_url); ?>" class="boxed-btn "><?php echo e($data->btn_01_text); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if(!empty(filter_static_option_value('home_page_key_feature_section_status',$static_field_data))): ?>
<div class="header-bottom-area bg-blue padding-bottom-120">
    <div class="header-bottom-inner">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-header-bottom-item style-0<?php echo e($key+1); ?>">
                            <div class="icon">
                                <i class="<?php echo e($data->icon); ?>"></i>
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
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data))): ?>
<section class="top-experience-area bg-blue">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="experience-content">
                    <div class="content">
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_title',$static_field_data)); ?></h2>
                    </div>
                    <div class="col-lg-09 offset-lg-3">
                        <div class="experience-right">
                            <div class="experience-img">
                                <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_01_about_us_video_background_image',$static_field_data)); ?>

                            </div>
                            <div class="vdo-btn">
                                <a class="video-play-btn mfp-iframe"
                                   href="<?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_video_url',$static_field_data)); ?>"><i
                                        class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
<section class="what-we-cover padding-bottom-85 padding-top-160">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-50">
                    <h3 class="title"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_service_area_title',$static_field_data)); ?></h3>
                    <p><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_service_area_description',$static_field_data)); ?></p>
                </div>
            </div>
        </div>
        <?php if(filter_static_option_value('home_page_01_service_area_item_type',$static_field_data) === 'category'): ?>
        <?php $__currentLoopData = $all_service_category->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-what-we-cover-item margin-bottom-50">
                            <?php if($data->icon_type == 'icon' || $data->icon_type == ''): ?>
                            <div class="icon style-0<?php echo e($key+1); ?>">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            <?php else: ?>
                                <div class="img-icon">
                                    <?php echo render_image_markup_by_attachment_id($data->img_icon); ?>

                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h4 class="title">
                                    <a href="<?php echo e(route('frontend.services.category',[ 'id' => $data->id , 'any' => Str::slug($data->name)])); ?>"><?php echo e($data->name); ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php $__currentLoopData = $all_service->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-what-we-cover-item margin-bottom-50">
                                <?php if($data->icon_type == 'icon' || $data->icon_type == ''): ?>
                                    <div class="icon style-0<?php echo e($key+1); ?>">
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
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_quality_section_status',$static_field_data))): ?>
<div class="quality-area">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_01_quality_area_background_image',$static_field_data),'only-mobile-version-show','full'); ?>

                <div class="quality-img" <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_01_quality_area_background_image',$static_field_data)); ?>></div>
            </div>
            <div class="col-lg-6">
                <div class="quality-content">
                    <div class="quality-content-wrapper">
                        <h4 class="title"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_title',$static_field_data)); ?></h4>
                        <p><?php echo filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_description',$static_field_data); ?></p>

                        <?php if(!empty(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_button_status',$static_field_data))): ?>
                            <div class="btn-wrapper margin-top-40">
                                <a href="<?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_button_url',$static_field_data)); ?>"
                                   class="boxed-btn"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_button_title',$static_field_data)); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
<div class="counterup-area counterup-bg padding-top-115 padding-bottom-115">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6">
                <div class="singler-counterup-item-01">
                    <div class="icon">
                        <i class="<?php echo e($data->icon); ?>" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <div class="count-wrap"><span class="count-num"><?php echo e($data->number); ?></span><?php echo e($data->extra_text); ?></div>
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
<div class="case-studies-area">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title white bg-blue desktop-center padding-top-110 padding-bottom-55">
                    <h3 class="title"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_case_study_title',$static_field_data)); ?></h3>
                    <p><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_case_study_description',$static_field_data)); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="case-studies-slider-active global-carousel-init"
                     data-loop="true"
                     data-desktopitem="3"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-nav="true"
                     data-center="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                    <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slider-img"
                            <?php echo render_background_image_markup_by_attachment_id($data->image); ?>

                        >
                            <div class="slider-inner-text">
                                <a href="<?php echo e(route('frontend.work.single',$data->slug)); ?>">
                                    <h4 class="title"><?php echo e($data->title); ?></h4>
                                </a>
                                <p><?php echo e($data->excerpt); ?></p>
                                <div class="btn-wrapper padding-top-20">
                                    <a href="<?php echo e(route('frontend.work.single',$data->slug)); ?>"
                                       class="boxed-btn"><?php echo e(filter_static_option_value('case_study_'.$user_select_lang_slug.'_read_more_text',$static_field_data)); ?></a>
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
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
<section class="testimonial-area bg-image padding-top-85 padding-bottom-40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center padding-bottom-20">
                    <h2 class="title"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-carousel-area margin-top-10">
                    <div class="testimonial-carousel global-carousel-init"
                         data-loop="true"
                         data-desktopitem="1"
                         data-mobileitem="1"
                         data-tabletitem="1"
                         data-autoplay="true"
                         data-margin="0"
                    >
                        <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-testimonial-item">
                                <div class="content">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    </div>
                                    <p class="description"><?php echo e($data->description); ?></p>
                                    <div class="icon">
                                        <i class="flaticon-right-quote-1"></i>
                                    </div>
                                    <div class="author-details">
                                        <div class="author-meta">
                                            <h4 class="title"><?php echo e($data->name); ?></h4>
                                            <span class="designation"><?php echo e($data->designation); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_price_plan_section_status',$static_field_data))): ?>
<section class="pricing-plan-area bg-image price-inner padding-bottom-120 margin-top-70 padding-top-110"
    <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_01_price_plan_background_image',$static_field_data)); ?>

>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white desktop-center padding-bottom-55">
                    <h2 class="title"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_price_plan_section_title',$static_field_data)); ?></h2>
                    <p><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_price_plan_section_description',$static_field_data)); ?> </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <div class="price-plan-slider global-carousel-init"
                         data-loop="true"
                         data-desktopitem="3"
                         data-mobileitem="1"
                         data-tabletitem="2"
                         data-autoplay="true"
                         data-margin="30"
                         data-nav="true"
                    >
                    <?php $__currentLoopData = $all_price_plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-price-plan-01 <?php if(!empty($data->highlight)): ?> style-03 active <?php endif; ?>">
                            <div class="price-header">
                                <div class="name-box">
                                    <h4 class="name"><?php echo e($data->title); ?></h4>
                                </div>
                                <div class="price-wrap">
                                    <span class="price"><?php echo e(amount_with_currency_symbol($data->price)); ?></span><span
                                        class="month"><?php echo e($data->type); ?></span>
                                </div>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <?php
                                        $features = explode("\n",$data->features);
                                    ?>
                                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($item); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="btn-wrapper">
                                <?php
                                    $url = !empty($data->url_status) ? route('frontend.plan.order',['id' => $data->id]) : $data->btn_url;
                                ?>
                                <a href="<?php echo e($url); ?>" rel="canonical" class="boxed-btn"><?php echo e($data->btn_text); ?></a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data))): ?>
<div class="client-section bg-liteblue padding-bottom-70 padding-top-70">
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
<?php if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data))): ?>
<section class="blog-area padding-top-110 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-55">
                    <h3 class="title"><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_latest_news_title',$static_field_data)); ?></h3>
                    <p><?php echo e(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_latest_news_description',$static_field_data)); ?> </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-grid-carosel-wrapper">
                    <div class="blog-grid-carousel global-carousel-init"
                         data-loop="true"
                         data-desktopitem="2"
                         data-mobileitem="1"
                         data-tabletitem="2"
                         data-autoplay="true"
                         data-nav="true"
                         data-margin="30"
                    >
                        <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-blog-grid-01"
                                <?php echo render_background_image_markup_by_attachment_id($data->image,'large'); ?>

                            >
                                <div class="content">
                                    <ul class="post-meta">
                                        <li>
                                            <a href="<?php echo e(route('frontend.blog.single', $data->slug)); ?>"><i
                                                    class="far fa-clock"></i> <?php echo e(date_format($data->created_at,'d M Y')); ?>

                                            </a></li>
                                        <li>
                                            <div class="cats"><i class="fas fa-tags"></i><?php echo get_blog_category_by_id($data->blog_categories_id,'link'); ?></div>
                                        </li>
                                    </ul>
                                    <h4 class="title"><a
                                            href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php echo $__env->make('frontend.partials.contact-section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/home-pages/home-01.blade.php ENDPATH**/ ?>