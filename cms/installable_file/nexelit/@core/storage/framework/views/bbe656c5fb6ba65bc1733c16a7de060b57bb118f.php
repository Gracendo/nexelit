<?php
    $post_img = null;
    $blog_image = get_attachment_image_by_id($event->image,"full",false);
    $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
?>
<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url"  content="<?php echo e(route('frontend.events.single',$event->slug)); ?>" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="<?php echo e($event->title); ?>" />
    <meta property="og:image" content="<?php echo e($post_img); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($event->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($event->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($event->meta_tags); ?>">
    <meta name="tags" content="<?php echo e($event->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-event-details">
                        <div class="thumb">
                            <?php echo render_image_markup_by_attachment_id($event->image,'','large'); ?>

                        </div>
                        <div class="content">
                            <div class="details-content-area">
                                <?php echo $event->content; ?>

                            </div>
                            <div class="event-venue-details-information margin-top-40">
                                <h4 class="venue-title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_venue_title')); ?></h4>
                                <div class="bottom-content">
                                    <div class="venue-details">
                                        <?php if(!empty($event->venue)): ?>
                                        <div class="venue-details-block">
                                            <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_venue_name_title')); ?></h4>
                                            <span class="details"><?php echo e($event->venue); ?></span>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(!empty($event->venue_location)): ?>
                                        <div class="venue-details-block">
                                            <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_venue_location_title')); ?></h4>
                                            <span class="details"><?php echo e($event->venue_location); ?></span>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(!empty($event->venue_phone)): ?>
                                        <div class="venue-details-block">
                                            <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_venue_phone_title')); ?></h4>
                                            <span class="details"><?php echo e($event->venue_phone); ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($event->venue_location)): ?>
                                    <div class="map-location">
                                        <?php echo render_embed_google_map($event->venue_location); ?>

                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(time() >= strtotime($event->date)): ?>
                                <p class="alert alert-danger  margin-top-30"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_event_expire_text')); ?></p>
                            <?php elseif($event->available_tickets < 1): ?>
                                <p class="alert alert-danger  margin-top-30"><?php echo e(__('No tickets available')); ?></p>
                            <?php else: ?>
                                <div class="reserve-event-seat margin-top-30">
                                    <a href="<?php echo e(route('frontend.event.booking',$event->id)); ?>" class="btn-boxed style-01"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_reserve_button_title')); ?></a>
                                    <p class="info-text padding-top-10"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_available_ticket_text').' '.$event->available_tickets); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <?php if(time() >= strtotime($event->date)): ?>
                            <p class="alert alert-danger"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_event_expire_text')); ?></p>
                        <?php else: ?>
                        <div class="counterdown-wrap event-page">
                            <div id="event_countdown"></div>
                        </div>
                        <?php endif; ?>
                        <div class="widget event-info">
                            <h4 class="widget-title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_event_info_title')); ?></h4>
                            <ul class="icon-with-title-description">
                                <li>
                                    <div class="icon"><i class="far fa-calendar-plus"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_date_title')); ?></h4>
                                        <span class="details"><?php echo e(date('d M Y',strtotime($event->date))); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><i class="fas fa-clock"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_time_title')); ?></h4>
                                        <span class="details"><?php echo e($event->time); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_cost_title')); ?></h4>
                                        <span class="details"><?php echo e(amount_with_currency_symbol($event->cost)); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><i class="far fa-folder-open"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_category_title')); ?></h4>
                                        <span class="details">
                                           <?php echo get_events_category_by_id($event->category_id,'link'); ?>

                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget event-info">
                            <h4 class="widget-title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_organizer_title')); ?></h4>
                            <ul class="icon-with-title-description">
                                <?php if(!empty($event->organizer)): ?>
                                <li>
                                    <div class="icon"><i class="fas fa-store"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_organizer_name_title')); ?></h4>
                                        <span class="details"><?php echo e($event->organizer); ?></span>
                                    </div>
                                </li>
                                <?php endif; ?>
                                 <?php if(!empty($event->organizer_email)): ?>
                                <li>
                                    <div class="icon"><i class="fas fa-envelope"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_organizer_email_title')); ?></h4>
                                        <span class="details"><?php echo e($event->organizer_email); ?></span>
                                    </div>
                                </li>
                                <?php endif; ?>
                                <?php if(!empty($event->organizer_phone)): ?>
                                <li>
                                    <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_organizer_phone_title')); ?></h4>
                                        <span class="details"><?php echo e($event->organizer_phone); ?></span>
                                    </div>
                                </li>
                                <?php endif; ?>
                                <?php if(!empty($event->organizer_website)): ?>
                                <li>
                                    <div class="icon"><i class="fas fa-globe"></i></div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(get_static_option('event_single_'.$user_select_lang_slug.'_organizer_website_title')); ?></h4>
                                        <span class="details"><?php echo e($event->organizer_website); ?></span>
                                    </div>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php echo App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('event',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/common/js/countdown.jquery.js')); ?>"></script>
    <script>
        var ev_offerTime = "<?php echo e($event->date); ?>";
        var ev_year = ev_offerTime.substr(0, 4);
        var ev_month = ev_offerTime.substr(5, 2);
        var ev_day = ev_offerTime.substr(8, 2);

        if (ev_offerTime) {
            $('#event_countdown').countdown({
                year: ev_year,
                month: ev_month,
                day: ev_day,
                labels: true,
                labelText: {
                    'days': "<?php echo e(__('days')); ?>",
                    'hours': "<?php echo e(__('hours')); ?>",
                    'minutes': "<?php echo e(__('min')); ?>",
                    'seconds': "<?php echo e(__('sec')); ?>",
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/events/event-single.blade.php ENDPATH**/ ?>