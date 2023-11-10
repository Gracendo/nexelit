<html>
<head>
    <title> <?php echo e(__('Stripe Payment Gateway')); ?></title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div class="stripe-payment-wrapper">
    <div class="srtipe-payment-inner-wrapper">
            <input type="hidden" name="order_id" id="order_id_input" value="<?php echo e($stripe_data['order_id']); ?>"/>
        <form id="stripe_form">
            <?php $__currentLoopData = $stripe_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_name => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="<?php echo e($field_name); ?>"  value="<?php echo e($value); ?>"/>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </form>
        <div class="btn-wrapper">
            <button id="payment_submit_btn"></button>
        </div>
    </div>
</div>

<script>
    (function($){
        "use strict";
        // Create a Stripe client
        var stripe = Stripe("<?php echo e($stripe_data['public_key']); ?>");
        var orderID = document.getElementById('order_id_input').value;
        var submitBtn = document.getElementById('payment_submit_btn');

        document.addEventListener('DOMContentLoaded',function (){
            submitBtn.dispatchEvent(new Event('click'));
        },false);


        submitBtn.addEventListener('click', function () {
            // Create a new Checkout Session using the server-side endpoint you
            submitBtn.innerText = "<?php echo e(__('Redirecting..')); ?>"
            submitBtn.disabled = true;
            var form = document.getElementById('stripe_form');
            var formData = new FormData(form);
            // created in step 3.
            fetch("<?php echo e(route('xg.payment.gateway.stripe')); ?>", {
                headers: {
                    "X-CSRF-TOKEN" : "<?php echo e(csrf_token()); ?>",
                },
                method: 'POST',
                processData:false,
                contentType: false,
                body: formData
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (session) {
                    if(session.hasOwnProperty('msg')){
                        alert(session.msg);
                        //redirect to cancel page ==
                        window.location = document.querySelector('input[name="cancel_url"]').value;
                    }
                    return stripe.redirectToCheckout({sessionId: session.id});
                })
                .then(function (result) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, you should display the localized error message to your
                    // customer using `error.message`.
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function (error) {
                    console.error('Error:', error);
                });
        });
    })();
</script>
</body>
</html>
<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/vendor/xgenious/paymentgateway/src/Providers/../../resources/views/stripe.blade.php ENDPATH**/ ?>