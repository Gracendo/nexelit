<?php if(session()->has('msg')): ?>
    <div class="alert alert-<?php echo e(session('type')); ?>">
        <?php echo session('msg'); ?>

    </div>
<?php endif; ?>
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/partials/message.blade.php ENDPATH**/ ?>