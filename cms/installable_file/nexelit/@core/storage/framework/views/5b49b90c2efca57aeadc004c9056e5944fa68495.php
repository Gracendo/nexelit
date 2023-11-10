<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Wishlist')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Wishlist')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/toastr.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="product-content-area padding-top-120 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   <div class="cart-wrapper">
                       <div class="wishlist-table-wrapper">
                           <?php echo \App\Facades\Wishlist::wishlistTable(); ?>

                       </div>
                   </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/frontend/js/toastr.min.js')); ?>"></script>
    <script>
        (function ($) {
            'use strict';
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }


            $(document).on('click','.ajax_remove_wishlist_item',function (e) {
                e.preventDefault();
                var el = $(this);
                var cart_index = el.data('wishlistindex');
                $.ajax({
                   url: "<?php echo e(route('frontend.products.wishlist.ajax.remove')); ?>",
                   type: "POST",
                   data: {
                       _token : "<?php echo e(csrf_token()); ?>",
                       cart_index : cart_index
                   },
                    beforeSend: function(){
                        el.next('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                   success:function (data) {
                       el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                       $('.pcount home-page-21-wishlist-icon-top').text(data.total_cart_item);
                       $('.wishlist-table-wrapper').html(data.cart_table_markup);
                       var msg = "<?php echo e(__('Wishlist Item Removed')); ?>";
                       toastr.error(msg);
                   }
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/products/product-wishlist.blade.php ENDPATH**/ ?>