<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
    <div class="search-popup-inner-wrapper">
        <form action="<?php echo e(route('frontend.blog.search')); ?>" method="get" class="search-form-warp">
            <span class="search-popup-close-btn">×</span>
            <div class="form-group">
                <input type="text" class="form-control search-field" name="search" placeholder="<?php echo e(__('Search...')); ?>">
            </div>
            <div class="form-group">
                <select name="search_type" id="search_popup_search_type" class="form-control">
                    <?php if(!empty(get_static_option('product_module_status')) && $home_page_variant == '19'): ?>
                            <option value="product"><?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?></option>
                            <option value="blog"><?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_name')); ?></option>
                    <?php elseif( $home_page_variant == '20'): ?>
                        <option value="blog"><?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_name')); ?></option>
                        <option value="product"><?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?></option>
                    <?php endif; ?>

                    <?php if(!empty(get_static_option('events_module_status'))): ?>
                    <option value="event"><?php echo e(get_static_option('events_page_'.$user_select_lang_slug.'_name')); ?></option>
                     <?php endif; ?>


                    <?php if(!empty(get_static_option('knowledgebase_module_status'))): ?>
                    <option value="knowledgebase"><?php echo e(get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_name')); ?></option>
                     <?php endif; ?>
                </select>
            </div>
            <button class="close-btn border-none" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/partials/search-popup.blade.php ENDPATH**/ ?>