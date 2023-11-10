<div class="blog-classic-item-01 <?php echo e($margin ? 'margin-bottom-60' : ''); ?>">
    <div class="thumbnail">
        <?php echo render_image_markup_by_attachment_id($blog->image); ?>

    </div>
    <div class="content">
        <ul class="post-meta">
            <li><a href="<?php echo e(route('frontend.blog.single',$blog->slug)); ?>"><i class="fa fa-user"></i> <?php echo e($blog->author); ?></a></li>
            <li><a href="<?php echo e(route('frontend.blog.single',$blog->slug)); ?>"><i class="far fa-clock"></i> <?php echo e(date_format($blog->created_at,'d M y')); ?></a></li>
            <li>
                <div class="cats"><i class="fas fa-microchip"></i>
                    <?php echo get_blog_category_by_id($blog->blog_categories_id,'link'); ?>

                </div>
            </li>
        </ul>
        <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',$blog->slug)); ?>"><?php echo e($blog->title); ?></a></h4>
        <p><?php echo e($blog->excerpt); ?></p>
        <div class="btn-wrapper">
            <a href="<?php echo e(route('frontend.blog.single',$blog->slug)); ?>" class="boxed-btn reverse-color"><?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_read_more_btn_text')); ?></a>
        </div>
    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/blog/grid.blade.php ENDPATH**/ ?>