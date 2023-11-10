<html>
<head>
    <title><?php echo e(__('PayStack Payment')); ?></title>
</head>
<body>
<form method="POST" action="<?php echo e($paystack_data['route']); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
    <?php echo csrf_field(); ?>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <input type="hidden" name="name" value="<?php echo e($paystack_data['name']); ?>">
            <input type="hidden" name="email" value="<?php echo e($paystack_data['email']); ?>"> 
            <input type="hidden" name="order_id" value="<?php echo e($paystack_data['order_id']); ?>">
            <input type="hidden" name="orderID" value="<?php echo e($paystack_data['order_id']); ?>">
            <input type="hidden" name="amount" value="<?php echo e($paystack_data['price'] * 100); ?>"> 
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="currency" value="<?php echo e($paystack_data['currency']); ?>">
            <input type="hidden" name="merchantEmail" value="<?php echo e($paystack_data['merchantEmail']); ?>">
            <input type="hidden" name="secretKey" value="<?php echo e(base64_encode($paystack_data['secretKey'])); ?>">
            <input type="hidden" name="publicKey" value="<?php echo e($paystack_data['publicKey']); ?>">
            <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['track' => $paystack_data['track'],'type' => $paystack_data['type'],'order_id' => $paystack_data['order_id']])); ?>" > 
            <input type="hidden" name="reference" value="<?php echo e(Unicodeveloper\Paystack\Facades\Paystack::genTranxRef()); ?>"> 
            <p>
                <button id="submit_btn" type="submit" ><?php echo e(__('Redirecting..')); ?></button>
            </p>
        </div>
    </div>
</form>

<script>
    (function(){
        "use strict";
        var submitBtn = document.querySelector('#submit_btn');
        document.addEventListener('DOMContentLoaded',function (){
            submitBtn.dispatchEvent(new MouseEvent('click'));
        },false);

        submitBtn.addEventListener('click', function () {
            // Create a new Checkout Session using the server-side endpoint you
            submitBtn.value = "<?php echo e(__('Do Not Close This page..')); ?>"
            // submitBtn.disabled = true;
            submitBtn.style.color = "#fff";
            submitBtn.style.backgroundColor = "#c54949";
            submitBtn.style.border = "none";
        });

    })();
</script>
</body>
</html>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/vendor/xgenious/paymentgateway/src/Providers/../../resources/views/paystack.blade.php ENDPATH**/ ?>