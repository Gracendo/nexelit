<html>
<head>
    <title><?php echo e(__('Cashfree Payment Gateway')); ?></title>
</head>
<body>
<form class="redirectForm" method="post" action="<?php echo e($payment_data['action']); ?>">
    <input type="hidden" name="appId" value="<?php echo e($payment_data['app_id']); ?>"/>
    <input type="hidden" name="orderId" value="<?php echo e($payment_data['order_id']); ?>"/>
    <input type="hidden" name="orderAmount" value="<?php echo e($payment_data['amount']); ?>"/>
    <input type="hidden" name="orderCurrency" value="<?php echo e($payment_data['currency']); ?>"/>
    <input type="hidden" name="orderNote" value="<?php echo e($payment_data['order_id']); ?>"/>
    <input type="hidden" name="customerName" value="<?php echo e($payment_data['name']); ?>"/>
    <input type="hidden" name="customerEmail" value="<?php echo e($payment_data['email']); ?>"/>
    <input type="hidden" name="customerPhone" value="<?php echo e($payment_data['phone']); ?>"/>
    <input type="hidden" name="returnUrl" value="<?php echo e($payment_data['return_url']); ?>"/>
    <input type="hidden" name="notifyUrl" value="<?php echo e($payment_data['notify_url']); ?>"/>
    <input type="hidden" name="signature" value="<?php echo e($payment_data['signature']); ?>"/>

    <button type="submit" id="paymentbutton" class="btn btn-block btn-lg bg-ore continue-payment">Continue to Payment</button>

</form>
<script>
    (function(){
        "use strict";
        
        var submitBtn = document.querySelector('#paymentbutton');
        submitBtn.innerHTML = "<?php echo e(__('Redirecting Please Wait...')); ?>";
        submitBtn.style.color = "#fff";
        submitBtn.style.backgroundColor = "#c54949";
        submitBtn.style.border = "none";
        document.addEventListener('DOMContentLoaded',function (){
            submitBtn.dispatchEvent(new MouseEvent('click'));
        },false);
    })();
</script>
</body>
</html>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/vendor/xgenious/paymentgateway/src/Providers/../../resources/views/cashfree.blade.php ENDPATH**/ ?>