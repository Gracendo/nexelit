<div class="form-group">
    <?php
    $value = $icon ?? get_static_option($name);
    ?>
    <label for="icon" class="d-block"><?php echo e($title); ?></label>
    <div class="btn-group">
        <button type="button" class="btn btn-primary iconpicker-component">
            <i class="<?php echo e($value); ?>"></i>
        </button>
        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                data-selected="<?php echo e($value); ?>" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only"><?php echo e(__('Toggle Dropdown')); ?></span>
        </button>
        <div class="dropdown-menu"></div>
    </div>
    <input type="hidden" class="form-control"  id="icon" value="<?php echo e($value); ?>" name="<?php echo e($name); ?>">
</div>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/backend/icon-field.blade.php ENDPATH**/ ?>