<?php $__env->startSection('payment_redirect'); ?>
<form method="post" action="<?php echo e($txn_url); ?>" name="f1" style="visibility: hidden;">
<table border="1">
<tbody>
<?php $__currentLoopData = $params; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" name="<?php echo e($key); ?>"  value="<?php echo e($value); ?>" />
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" name="CHECKSUMHASH" value="<?php echo e($checkSum); ?>">
</tbody>
</table>
<script type="text/javascript">
document.f1.submit();
</script>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($view, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/vendor/anandsiddharth/laravel-paytm-wallet/src/resources/views/form.blade.php ENDPATH**/ ?>