<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/colorpicker.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Color Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Color Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.color.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="site_color"><?php echo e(__('Site Main Color Settings')); ?></label>
                                <input type="text" name="site_color" style="background-color: <?php echo e(get_static_option('site_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('site_color')); ?>" id="site_color">
                                <small><?php echo e(__('you change site main color from here, it will replace website main color')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_three"><?php echo e(__('Site Main Color Three Settings')); ?></label>
                                <input type="text" name="main_color_three" style="background-color: <?php echo e(get_static_option('main_color_three')); ?>;color: #ff805d;" class="form-control" value="<?php echo e(get_static_option('main_color_three')); ?>" >
                                <small><?php echo e(__('you change site main color three from here, it will replace website main color three')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_three_rgb"><?php echo e(__('Site Main Color Three RGB Settings')); ?></label>
                                <input type="text" name="main_color_three_rgb" style="background-color: <?php echo e(get_static_option('main_color_three_rgb')); ?>;color: #FF805D;" class="form-control" value="<?php echo e(get_static_option('main_color_three_rgb')); ?>" >
                                <small><?php echo e(__('you change site main color three rgb from here, it will replace website main color three rgb')); ?></small>
                            </div>
                             <div class="form-group">
                                <label for="main_color_four"><?php echo e(__('Site Main Color Four Settings')); ?></label>
                                <input type="text" name="main_color_four" style="background-color: <?php echo e(get_static_option('main_color_four')); ?>;color: #ff1747;" class="form-control" value="<?php echo e(get_static_option('main_color_four')); ?>" >
                                <small><?php echo e(__('you change site main color four from here, it will replace website main color four')); ?></small>
                            </div>
                             <div class="form-group">
                                <label for="main_color_four_rgb"><?php echo e(__('Site Main Color Four RGB Settings')); ?></label>
                                <input type="text" name="main_color_four_rgb" style="background-color: <?php echo e(get_static_option('main_color_four_rgb')); ?>;color: #FF1747;" class="form-control" value="<?php echo e(get_static_option('main_color_four_rgb')); ?>" >
                                <small><?php echo e(__('you change site main color four from here, it will replace website main color four rgb')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_five"><?php echo e(__('Site Main Color Five Settings')); ?></label>
                                <input type="text" name="main_color_five" style="background-color: <?php echo e(get_static_option('main_color_five')); ?>;color: #fcda69;" class="form-control" value="<?php echo e(get_static_option('main_color_five')); ?>">
                                <small><?php echo e(__('you change site main color five from here, it will replace website main color five')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="main_color_five_rgb"><?php echo e(__('Site Main Color Five RGB Settings')); ?></label>
                                <input type="text" name="main_color_five_rgb" style="background-color: <?php echo e(get_static_option('main_color_five_rgb')); ?>;color: #FFDA69;" class="form-control" value="<?php echo e(get_static_option('main_color_five_rgb')); ?>">
                                <small><?php echo e(__('you change site main color five from here, it will replace website main color five')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="site_color"><?php echo e(__('Site Base Color Two Settings')); ?></label>
                                <input type="text" name="site_main_color_two" style="background-color: <?php echo e(get_static_option('site_main_color_two')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('site_main_color_two')); ?>" id="site_main_color_two">
                                <small><?php echo e(__('you change site base color two color from here, it will replace website site base color two color')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="site_secondary_color"><?php echo e(__('Site Secondary Color Settings')); ?></label>
                                <input type="text" name="site_secondary_color" style="background-color: <?php echo e(get_static_option('site_secondary_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('site_secondary_color')); ?>" id="site_secondary_color">
                                <small><?php echo e(__('you change site secondary color from here, it will replace website secondary color')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="site_heading_color"><?php echo e(__('Site Heading Color')); ?></label>
                                <input type="text" name="site_heading_color" style="background-color: <?php echo e(get_static_option('site_heading_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('site_heading_color')); ?>" id="site_heading_color">
                                <small><?php echo e(__('you can change site heading color from there , when you chnage this color it will reflect the color in all the heading like (h1,h2,h3,h4.h5.h6)')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="site_paragraph_color"><?php echo e(__('Site Paragraph Color')); ?></label>
                                <input type="text" name="site_paragraph_color" style="background-color: <?php echo e(get_static_option('site_paragraph_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('site_paragraph_color')); ?>" id="site_paragraph_color">
                                <small><?php echo e(__('you can change site paragraph color from there')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="portfolio_home_color"><?php echo e(__('Portfolio Home Color')); ?></label>
                                <input type="text" name="portfolio_home_color" style="background-color: <?php echo e(get_static_option('portfolio_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('portfolio_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="logistics_home_color"><?php echo e(__('Logistics Home Color')); ?></label>
                                <input type="text" name="logistics_home_color" style="background-color: <?php echo e(get_static_option('logistics_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('logistics_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="industry_home_color"><?php echo e(__('Industry Home Color')); ?></label>
                                <input type="text" name="industry_home_color" style="background-color: <?php echo e(get_static_option('industry_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('industry_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="construction_home_color"><?php echo e(__('Construction Home Color')); ?></label>
                                <input type="text" name="construction_home_color" style="background-color: <?php echo e(get_static_option('construction_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('construction_home_color')); ?>" >
                            </div>

                            <div class="form-group">
                                <label for="lawyer_home_color"><?php echo e(__('Lawyer Home Color')); ?></label>
                                <input type="text" name="lawyer_home_color" style="background-color: <?php echo e(get_static_option('lawyer_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('lawyer_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="political_home_color"><?php echo e(__('Political Home Color')); ?></label>
                                <input type="text" name="political_home_color" style="background-color: <?php echo e(get_static_option('political_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('political_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="medical_home_color"><?php echo e(__('Medical Home Color One')); ?></label>
                                <input type="text" name="medical_home_color" style="background-color: <?php echo e(get_static_option('medical_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('medical_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="medical_home_color_two"><?php echo e(__('Medical Home Color Two')); ?></label>
                                <input type="text" name="medical_home_color_two" style="background-color: <?php echo e(get_static_option('medical_home_color_two')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('medical_home_color_two')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="fruits_home_color"><?php echo e(__('Fruits Home Color')); ?></label>
                                <input type="text" name="fruits_home_color" style="background-color: <?php echo e(get_static_option('fruits_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('fruits_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="fruits_home_heading_color"><?php echo e(__('Fruits Home Heading Color')); ?></label>
                                <input type="text" name="fruits_home_heading_color" style="background-color: <?php echo e(get_static_option('fruits_home_heading_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('fruits_home_heading_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="portfolio_home_dark_color"><?php echo e(__('Portfolio Home Dark One Color')); ?></label>
                                <input type="text" name="portfolio_home_dark_color" style="background-color: <?php echo e(get_static_option('portfolio_home_dark_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('portfolio_home_dark_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="portfolio_home_dark_two_color"><?php echo e(__('Portfolio Home Dark Two Color')); ?></label>
                                <input type="text" name="portfolio_home_dark_two_color" style="background-color: <?php echo e(get_static_option('portfolio_home_dark_two_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('portfolio_home_dark_two_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="charity_home_color"><?php echo e(__('Charity Home Color')); ?></label>
                                <input type="text" name="charity_home_color" style="background-color: <?php echo e(get_static_option('charity_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('charity_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="dagency_home_color"><?php echo e(__('Design Agency Home Color')); ?></label>
                                <input type="text" name="dagency_home_color" style="background-color: <?php echo e(get_static_option('dagency_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('dagency_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="cleaning_home_color"><?php echo e(__('Cleaning Home Color')); ?></label>
                                <input type="text" name="cleaning_home_color" style="background-color: <?php echo e(get_static_option('cleaning_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('cleaning_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="cleaning_home_two_color"><?php echo e(__('Cleaning Home Two Color')); ?></label>
                                <input type="text" name="cleaning_home_two_color" style="background-color: <?php echo e(get_static_option('cleaning_home_two_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('cleaning_home_two_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="course_home_color"><?php echo e(__('Course Home Color')); ?></label>
                                <input type="text" name="course_home_color" style="background-color: <?php echo e(get_static_option('course_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('course_home_color')); ?>" >
                            </div>

                            <div class="form-group">
                                <label for="course_home_two_color"><?php echo e(__('Course Home Two Color')); ?></label>
                                <input type="text" name="course_home_two_color" style="background-color: <?php echo e(get_static_option('course_home_two_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('course_home_two_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="grocery_home_color"><?php echo e(__('Grocery Home Color')); ?></label>
                                <input type="text" name="grocery_home_color" style="background-color: <?php echo e(get_static_option('grocery_home_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('grocery_home_color')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="grocery_home_two_color"><?php echo e(__('Grocery Home Two Color')); ?></label>
                                <input type="text" name="grocery_home_two_color" style="background-color: <?php echo e(get_static_option('grocery_home_two_color')); ?>;color: #fff;" class="form-control" value="<?php echo e(get_static_option('grocery_home_two_color')); ?>" >
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/colorpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                initColorPicker('#site_color');
                initColorPicker('#site_secondary_color');
                initColorPicker('#site_main_color_two');
                initColorPicker('#site_heading_color');
                initColorPicker('#site_paragraph_color');
                initColorPicker('input[name="portfolio_home_color"');
                initColorPicker('input[name="logistics_home_color"');
                initColorPicker('input[name="industry_home_color"');
                initColorPicker('input[name="construction_home_color"');
                initColorPicker('input[name="lawyer_home_color"');
                initColorPicker('input[name="political_home_color"');
                initColorPicker('input[name="medical_home_color"');
                initColorPicker('input[name="medical_home_color_two"');
                initColorPicker('input[name="fruits_home_color"');
                initColorPicker('input[name="fruits_home_heading_color"');
                initColorPicker('input[name="portfolio_home_dark_two_color"');
                initColorPicker('input[name="portfolio_home_dark_color"');
                initColorPicker('input[name="dagency_home_color"');
                initColorPicker('input[name="cleaning_home_color"');
                initColorPicker('input[name="cleaning_home_two_color"');
                initColorPicker('input[name="course_home_color"');
                initColorPicker('input[name="charity_home_color"');
                initColorPicker('input[name="course_home_two_color"');
                initColorPicker('input[name="grocery_home_color"');
                initColorPicker('input[name="grocery_home_two_color"');
                
                initColorPicker('input[name="main_color_three"');
                initColorPicker('input[name="main_color_three_rgb"');
                initColorPicker('input[name="main_color_four"');
                initColorPicker('input[name="main_color_four_rgb"');
                initColorPicker('input[name="main_color_five"');
                initColorPicker('input[name="main_color_five_rgb"');

                function initColorPicker(selector){
                    $(selector).ColorPicker({
                        color: '#852aff',
                        onShow: function (colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            $(selector).css('background-color', '#' + hex);
                            $(selector).val('#' + hex);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/general-settings/color-settings.blade.php ENDPATH**/ ?>