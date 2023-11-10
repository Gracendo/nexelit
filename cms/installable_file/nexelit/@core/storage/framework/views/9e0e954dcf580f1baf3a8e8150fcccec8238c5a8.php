<?php if(request()->routeIs('homepage') || request()->routeIs('frontend.homepage.demo')): ?>
    <meta property="og:title"  content="<?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?>" />
    <?php echo render_og_meta_image_by_attachment_id(filter_static_option_value('og_meta_image_for_site',$global_static_field_data)); ?>

    <title><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?> - <?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_tag_line',$global_static_field_data)); ?></title>
    <meta name="description" content="<?php echo e(filter_static_option_value('site_meta_'.$user_select_lang_slug.'_description',$global_static_field_data)); ?>">
    <meta name="tags" content="<?php echo e(filter_static_option_value('site_meta_'.$user_select_lang_slug.'_tags',$global_static_field_data)); ?>">
<?php else: ?>
    <?php echo $__env->yieldContent('page-meta-data'); ?>
    <title>
        <?php echo $__env->yieldContent('site-title'); ?>
        <?php if (! empty(trim($__env->yieldContent('site-title')))): ?> - <?php else: ?> <?php echo $__env->yieldContent('page-title'); ?> -  <?php endif; ?>
        <?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?>

    </title>
    <?php echo $__env->yieldContent('og-meta'); ?>
<?php endif; ?>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/partials/og-meta.blade.php ENDPATH**/ ?>