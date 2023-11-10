<a tabindex="0" class="btn btn-warning btn-xs mb-3 mr-1 swal_change_language_button">
    <?php echo e(__('Make Change')); ?>

</a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/components/change-default-lang.blade.php ENDPATH**/ ?>