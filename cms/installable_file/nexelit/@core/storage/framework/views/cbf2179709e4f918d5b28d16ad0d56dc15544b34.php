<?php 
if(empty(get_static_option('home_page_page_builder_status')) && in_array($home_page_variant,['07','09','19']) || Route::currentRouteName() == 'frontend.course.lesson'){ return;} 
?>
<?php if(!empty(get_static_option('home_page_support_bar_section_status'))): ?>
    <div class="top-bar-area header-variant-<?php echo e(get_static_option('home_page_variant')); ?>">
        <div class="container <?php if($home_page_variant == '20'): ?> container-two" <?php endif; ?>>
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-bar-inner">
                        <div class="left-content">
                            <ul class="social-icons">
                                <?php $__currentLoopData = $all_social_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($data->url); ?>" rel="canonical"><i class="<?php echo e($data->icon); ?>"></i></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="right-content">
                            <ul>
                                <?php if(auth()->check()): ?>
                                    <?php
                                        $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                    ?>
                                    <li class="login-register"><a href="<?php echo e($route); ?>"><?php echo e(__('Dashboard')); ?></a>  <span>/</span>
                                        <a href="<?php echo e(route('user.logout')); ?>"
                                           onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                                            <?php echo e(__('Logout')); ?>

                                        </a>
                                        <form id="userlogout-form" action="<?php echo e(route('user.logout')); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                <?php else: ?>
                                    <li class="login-register"><a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login')); ?></a> <span>/</span> <a href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Register')); ?></a></li>
                                <?php endif; ?>
                                <?php if(!empty(get_static_option('language_select_option'))): ?>
                                    <li>
                                        <select id="langchange">
                                            <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($user_select_lang_slug == $lang->slug): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>" class="lang-option"><?php echo e(explode('(',$lang->name)[0] ?? $lang->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty(get_static_option('navbar_button'))): ?>
                                    <li>
                                        <?php
                                            $custom_url = !empty(get_static_option('navbar_button_custom_url_status')) ? get_static_option('navbar_button_custom_url') : route('frontend.request.quote');
                                        ?>
                                        <div class="btn-wrapper">
                                            <a href="<?php echo e($custom_url); ?>" rel="canonical"
                                               <?php if(!empty(get_static_option('navbar_button_custom_url_status'))): ?> target="_blank"
                                               <?php endif; ?> class="boxed-btn reverse-color"><?php echo e(get_static_option('navbar_'.$user_select_lang_slug.'_button_text')); ?></a>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/beta/@core/resources/views/frontend/partials/supportbar.blade.php ENDPATH**/ ?>