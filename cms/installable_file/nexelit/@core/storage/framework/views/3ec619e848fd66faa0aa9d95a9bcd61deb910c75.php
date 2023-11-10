<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="knowledgebase-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="main-title"><?php echo e(get_static_option('site_knowledgebase_article_topic_'.$user_select_lang_slug.'_title')); ?></h4>
                    <div class="row">
                        <?php $__currentLoopData = $all_knowledgebase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic => $articles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-6">
                                <div class="article-with-topic-title-style-01">
                                    <?php if(!empty(get_topic_name_by_id($topic))): ?>
                                    <a href="<?php echo e(route('frontend.knowledgebase.category',['id' => $topic,'any' => Str::slug(get_topic_name_by_id($topic)) ])); ?>"> <h4 class="topic-title"><i class="fas fa-folder"></i> <?php echo e(get_topic_name_by_id($topic)); ?></h4></a>
                                    <?php endif; ?>
                                    <ul class="know-articles-list">
                                        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('frontend.knowledgebase.single',$art->slug)); ?>"><i class="far fa-file-alt"></i> <?php echo e($art->title); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <?php echo App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('knowledgebase',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/knowledgebase/knowledgebase.blade.php ENDPATH**/ ?>