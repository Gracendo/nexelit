<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add New User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                      <div class="header-wrap d-flex justify-content-between">
                          <h4 class="header-title"><?php echo e(__('New User')); ?></h4>
                          <a href="<?php echo e(route('admin.all.frontend.user')); ?>" class="btn btn-primary"><?php echo e(__('All Users')); ?></a>
                      </div>
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
                        <form action="<?php echo e(route('admin.frontend.new.user')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="<?php echo e(__('Enter name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="username"><?php echo e(__('Username')); ?></label>
                                <input type="text" class="form-control"  id="username" name="username" placeholder="<?php echo e(__('Username')); ?>">
                                <small class="text text-danger"><?php echo e(__('Remember this username, user will login using this username')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?></label>
                                <input type="text" class="form-control"  id="email" name="email" placeholder="<?php echo e(__('Email')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone"><?php echo e(__('Phone')); ?></label>
                                <input type="text" class="form-control"  id="phone" name="phone" placeholder="<?php echo e(__('Phone')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="country"><?php echo e(__('Country')); ?></label>
                                <?php echo get_country_field('country','country','form-control'); ?>

                            </div>
                            <div class="form-group">
                                <label for="state"><?php echo e(__('State')); ?></label>
                                <input type="text" class="form-control"  id="state" name="state" placeholder="<?php echo e(__('State')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="city"><?php echo e(__('City')); ?></label>
                                <input type="text" class="form-control"  id="city" name="city" placeholder="<?php echo e(__('City')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="zipcode"><?php echo e(__('Zipcode')); ?></label>
                                <input type="text" class="form-control"  id="zipcode" name="zipcode" placeholder="<?php echo e(__('Zipcode')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="address"><?php echo e(__('Address')); ?></label>
                                <input type="text" class="form-control"  id="address" name="address" placeholder="<?php echo e(__('Address')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo e(__('Password')); ?></label>
                                <input type="password" class="form-control"  id="password" name="password" placeholder="<?php echo e(__('Password')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"><?php echo e(__('Password Confirm')); ?></label>
                                <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="<?php echo e(__('Password Confirmation')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New User')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/frontend-user/add-new-user.blade.php ENDPATH**/ ?>