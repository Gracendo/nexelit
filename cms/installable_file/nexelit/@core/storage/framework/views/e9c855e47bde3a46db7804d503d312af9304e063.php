<html>
<head>
    <title><?php echo e(__('CinetPay Payment Gateway')); ?></title>
</head>
<body>
<?php echo $payButton; ?>

<script>
    (function(){
        "use strict";

        var submitBtn = document.querySelector('#goCinetPay button.cpButton');
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
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/vendor/xgenious/paymentgateway/src/Providers/../../resources/views/cinetpay.blade.php ENDPATH**/ ?>