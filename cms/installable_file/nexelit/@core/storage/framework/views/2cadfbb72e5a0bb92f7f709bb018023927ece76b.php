<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Popup Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Popup Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.popup.settings')); ?>" method="Post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home-<?php echo e($lang->slug); ?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="popup_selected_<?php echo e($lang->slug); ?>_id"><?php echo e(__('Select Popup')); ?></label>
                                            <select name="popup_selected_<?php echo e($lang->slug); ?>_id" class="form-control" id="popup_selected_<?php echo e($lang->slug); ?>_id">
                                                <?php if(isset($all_popup[$lang->slug])): ?>
                                                <?php $__currentLoopData = $all_popup[$lang->slug]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(get_static_option('popup_selected_'.$lang->slug.'_id') == $item->id): ?> selected <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="popup_enable_status"><strong><?php echo e(__('Popup Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="popup_enable_status" <?php if(!empty(get_static_option('popup_enable_status'))): ?> checked <?php endif; ?> id="popup_enable_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="popup_delay_time"><?php echo e(__('Popup Delay Time')); ?></label>
                                <input type="text" class="form-control" name="popup_delay_time" id="popup_delay_time" value="<?php echo e(get_static_option('popup_delay_time')); ?>">
                                <p class="info-text"><?php echo e(__('put number in miliseconds')); ?></p>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40" id="db_backup_btn"><?php echo e(__('Save Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/popup-settings.blade.php ENDPATH**/ ?>