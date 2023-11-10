<?php if(!empty(get_static_option('about_page_about_us_section_status'))): ?>
    <section class="top-experience-area padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="experience-author padding-bottom-100">
                        <div class="thumb-1">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('about_page_image_one')); ?>

                        </div>
                        <div class="thumb-2">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('about_page_image_two')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 p-0">
                    <div class="experience-content-03">
                        <div class="content">
                            <h2 class="title"><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_about_section_title')); ?></h2>
                            <p><?php echo get_static_option('about_page_'.$user_select_lang_slug.'_about_section_description'); ?></p>
                            <?php if(!empty(get_static_option('about_page_'.$user_select_lang_slug.'_about_section_quote_text'))): ?>
                                <div class="icon-area">
                                    <div class="icon">
                                        <i class="flaticon-right-quote-1"></i>
                                    </div>
                                    <p><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_about_section_quote_text')); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(!empty(get_static_option('about_page_key_feature_section_status'))): ?>
    <div class="header-bottom-area padding-bottom-80 padding-top-80">
        <div class="container">
            <div class="row no-gutters">
                <?php $a = 1;?>
                <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-header-bottom-item-02">
                            <div class="icon style-0<?php echo e($a); ?>">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            <div class="content">
                                <h4 class="title"><?php echo e($data->title); ?></h4>
                            </div>
                        </div>
                    </div>
                    <?php if($a == 4){$a=1;}else{$a++;} ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(get_static_option('about_page_global_network_section_status'))): ?>
    <div class="global-network-area bg-liteblue padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="global-content">
                        <h2 class="title">
                            <?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_global_network_title')); ?>

                        </h2>
                        <p>
                            <?php echo get_static_option('about_page_'.$user_select_lang_slug.'_global_network_description'); ?>

                        </p>
                        <?php if(!empty(get_static_option('about_page_'.$user_select_lang_slug.'_global_network_button_status'))): ?>
                            <div class="btn-wrapper padding-top-25">
                                <a href="<?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_global_network_button_url')); ?>" class="boxed-btn reverse-color"><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_global_network_button_title')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-img">
                        <?php echo render_image_markup_by_attachment_id(get_static_option('about_page_global_network_image')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(get_static_option('about_page_experience_section_status'))): ?>
    <section class="top-experience-area bg-blue">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="experience-right style-01"
                         <?php echo render_background_image_markup_by_attachment_id(get_static_option('about_page_experience_video_background_image')); ?> 
                    >
                        <div class="vdo-btn">
                            <a class="video-play-btn mfp-iframe" href="<?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_experience_video_url')); ?>"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="experience-content-02">
                        <h2 class="title"><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_experience_title')); ?></h2>
                        <p><?php echo get_static_option('about_page_'.$user_select_lang_slug.'_experience_description'); ?></p>
                        <div class="sign-area">
                            <p><?php echo get_static_option('about_page_'.$user_select_lang_slug.'_quote_text'); ?></p>
                            <div class="sing-img padding-top-10">
                                <?php echo render_image_markup_by_attachment_id(get_static_option('about_page_experience_signature_image')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(!empty(get_static_option('about_page_team_member_section_status'))): ?>
    <section class="creative-team-two padding-top-110 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title desktop-center padding-bottom-55">
                        <h3 class="title"><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_team_member_section_title')); ?></h3>
                        <p><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_team_member_section_description')); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-carousel global-carousel-init"
                         data-loop="true"
                         data-desktopitem="4"
                         data-mobileitem="1"
                         data-tabletitem="2"
                         data-autoplay="true"
                         data-margin="30"
                    >
                        <?php $__currentLoopData = $all_team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="team-section team-member-style-01">
                                <div class="team-img-cont">
                                    <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    <div class="social-link">
                                        <?php
                                            $social_fields = array(
                                                'icon_one' => 'icon_one_url',
                                                'icon_two' => 'icon_two_url',
                                                'icon_three' => 'icon_three_url',
                                            );
                                        ?>
                                        <ul>
                                            <?php $__currentLoopData = $social_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e($data->$value); ?>"><i class="<?php echo e($data->$key); ?>"></i></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="team-text">
                                    <h4 class="title"><?php echo e($data->name); ?></h4>
                                    <span><?php echo e($data->designation); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(!empty(get_static_option('about_page_testimonial_section_status'))): ?>
    <section class="testimonial-area bg-image-01 padding-top-110 padding-bottom-115"
            <?php echo render_background_image_markup_by_attachment_id(get_static_option('about_page_testimonial_background_image')); ?>

    >
        <div class=" container ">
            <div class="row justify-content-center ">
                <div class="col-lg-8 ">
                    <div class="section-title white desktop-center padding-bottom-20 ">
                        <h2 class="title "><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_testimonial_title')); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="testimonial-carousel global-carousel-init"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-autoplay="true"
                             data-margin="0"
                        >
                            <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-testimonial-item ">
                                    <div class="content style-01">
                                        <div class="thumb ">
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                        </div>
                                        <p class="description "><?php echo e($data->description); ?></p>
                                        <div class="author-details ">
                                            <div class="author-meta ">
                                                <h4 class="title "><?php echo e($data->name); ?></h4>
                                                <span class="designation "><?php echo e($data->designation); ?></span>
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
<?php if(!empty(get_static_option('about_page_brand_logo_section_status'))): ?>
    <div class="client-section padding-bottom-70 padding-top-85">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init"
                             data-loop="true"
                             data-desktopitem="5"
                             data-mobileitem="2"
                             data-tabletitem="3"
                             data-autoplay="true"
                             data-margin="80"
                        >
                            <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-brand">
                                    <div class="img-wrapper">
                                        <?php if(!empty($data->url) ): ?><a href="<?php echo e($data->url); ?>"><?php endif; ?>
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
<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/partials/about-page-content.blade.php ENDPATH**/ ?>