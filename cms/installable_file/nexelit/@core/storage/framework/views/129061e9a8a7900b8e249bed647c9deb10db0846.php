<a tabindex="0" class="btn btn-success btn-xs mb-3 mr-1 swal_change_approve_payment_button">
   <i class="ti-check"></i>
</a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/backend/payment-approve.blade.php ENDPATH**/ ?>