<?php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($blog_post->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 ?>

<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url"  content="<?php echo e(route('frontend.blog.single',$blog_post->slug)); ?>" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="<?php echo e($blog_post->title); ?>" />
    <meta property="og:image" content="<?php echo e($post_img); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($blog_post->meta_description); ?>">
    <meta name="tags" content="<?php echo e($blog_post->meta_tag); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($blog_post->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($blog_post->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-details-content-area padding-top-100 padding-bottom-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-item">
                        <div class="thumb">
                            <?php if(!empty($blog_image)): ?>
                                <img src="<?php echo e($blog_image['img_url']); ?>" alt="<?php echo e(__($blog_post->title)); ?>">
                            <?php endif; ?>
                            <?php if(!empty($blog_post->video_url)): ?>
                            <div class="popup-videos">
                                <a href="<?php echo e($blog_post->video_url); ?>" class="videos-play mfp-iframe" tabindex="0"> <i class="fas fa-play"></i> </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="entry-content">
                            <ul class="post-meta">
                                <li><i class="fas fa-calendar-alt"></i> <?php echo e(date_format($blog_post->created_at,'d M Y')); ?></li>
                                <li><i class="fas fa-user"></i> <?php echo e($blog_post->author); ?></li>
                                <li>
                                    <div class="cats">
                                        <i class="fas fa-folder"></i>
                                        <?php echo get_blog_category_by_id($blog_post->blog_categories_id,'link'); ?>

                                    </div>
                                </li>
                            </ul>
                           <div class="content-area">
                               <?php echo $blog_post->content; ?>

                           </div>
                        </div>
                        <div class="blog-details-footer">
                        <?php
                            $all_tags = explode(',',$blog_post->tags);
                        ?>
                        <?php if(count($all_tags) > 1): ?> 
                            <div class="left">
                                <ul class="tags">
                                    <li class="title"><?php echo e(get_static_option('blog_single_page_'.$user_select_lang_slug.'_tags_title')); ?></li>
                                    <?php $__currentLoopData = $all_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                    $slug = Str::slug($tag);
                                    ?> 
                                    <?php if(!empty($slug)): ?>
                                        <li><a href="<?php echo e(route('frontend.blog.tags.page',['name' => $slug])); ?>"><?php echo e($tag); ?></a></li>
                                    <?php endif; ?>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                            <div class="right">
                                <ul class="social-share">
                                    <li class="title"><?php echo e(get_static_option('blog_single_page_'.$user_select_lang_slug.'_share_title')); ?></li>
                                    <?php echo single_post_share(route('frontend.blog.single',$blog_post->slug),$blog_post->title,$post_img); ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php if(count($all_related_blog) > 1): ?>
                    <div class="related-post-area margin-top-40">
                        <div class="section-title ">
                            <h4 class="title "><?php echo e(get_static_option('blog_single_page_'.$user_select_lang_slug.'_related_post_title')); ?></h4>
                            <div class="related-news-carousel margin-top-30">
                                <?php $__currentLoopData = $all_related_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($data->id === $blog_post->id): ?> <?php continue; ?> <?php endif; ?>
                                    <div class="single-blog-grid-02">
                                        <div class="thumb">
                                            <?php echo render_image_markup_by_attachment_id($data->image,null,'grid'); ?>

                                        </div>
                                        <div class="content">
                                            <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="disqus-comment-area margin-top-40">
                        <div id="disqus_thread"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                   <?php echo $__env->make('frontend.pages.blog.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if(!empty(get_static_option('site_disqus_key'))): ?>
    <script>
        var disqus_config = function () {
        this.page.url = "<?php echo e(route('frontend.blog.single',$blog_post->slug)); ?>";
        this.page.identifier = "<?php echo e($blog_post->id); ?>";
        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = "https://<?php echo e(get_static_option('site_disqus_key')); ?>.disqus.com/embed.js";
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/blog/blog-single.blade.php ENDPATH**/ ?>