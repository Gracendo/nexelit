<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('User Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="login-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="user-dashboard-wrapper">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="mobile_nav">
                                <i class="fas fa-cogs"></i>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home')); ?>"><?php echo e(__('Dashboard')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.package.order')): ?> active <?php endif; ?>"  href="<?php echo e(route('user.home.package.order')); ?>" ><?php echo e(__('Packages Orders')); ?></a>
                            </li>
                            <?php if(!empty(get_static_option('product_module_status'))): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.home.product.order')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.product.order')); ?>"><?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Orders')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.home.product.download')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.product.download')); ?>"><?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Downloads')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('events_module_status'))): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.home.event.booking')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.event.booking')); ?>"><?php echo e(get_static_option('events_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Booking')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('donations_module_status'))): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.home.donations')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.donations')); ?>" ><?php echo e(__('All ')); ?> <?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_name')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('appointment_module_status'))): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.home.appointment.booking')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.appointment.booking')); ?>" ><?php echo e(__('Booked')); ?> <?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_name')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('course_module_status'))): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.home.course.enroll')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.course.enroll')); ?>" ><?php echo e(get_static_option('courses_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__("Enrolled")); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('support_ticket_module_status'))): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.home.support.tickets')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.support.tickets')); ?>" ><?php echo e(__('All')); ?> <?php echo e(get_static_option('support_ticket_page_'.$user_select_lang_slug.'_name')); ?></a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.edit.profile')): ?> active <?php endif; ?> " href="<?php echo e(route('user.home.edit.profile')); ?>"><?php echo e(__('Edit Profile')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.change.password')): ?> active <?php endif; ?> " href="<?php echo e(route('user.home.change.password')); ?>"><?php echo e(__('Change Password')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="<?php echo e(route('user.logout')); ?>"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(route('user.logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel">
                                <div class="message-show margin-top-10">
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
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
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
                                </div>
                                <?php echo $__env->yieldContent('section'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function (){
           $('select[name="country"] option[value="<?php echo e(auth()->guard('web')->user()->country); ?>"]').attr('selected',true);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/user-master.blade.php ENDPATH**/ ?>