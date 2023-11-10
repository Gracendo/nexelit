<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo e(asset('assets/frontend/js/toastr.min.js')); ?>"></script>
<script>
    (function () {
        "use strict";

        $(document).on('click','.ajax_add_to_wishlist_with_icon',function (e) {

            e.preventDefault();
            var allData = $(this).data();
            var el = $(this);
            $.ajax({
                url : "<?php echo e(route('frontend.products.add.to.wishlist.ajax')); ?>",
                type: "POST",
                data: {
                    _token : "<?php echo e(csrf_token()); ?>",
                    'product_id' : allData.product_id,
                },
                beforeSend: function(){
                    el.html('<i class="fas fa-spinner fa-spin mr-1"></i> ');
                },
                success: function (data) {
                    el.html('<i class="fa fa-shopping-bag" aria-hidden="true"></i>'+"<?php echo e(get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')); ?>");
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
                    toastr.success(data.msg);
                    el.html('<i class="fas fa-heart"></i>');
                    $('.home-page-21-wishlist-icon-top').text(data.total_wishlist_item);
                }
            });
        });


    })(jQuery);
</script><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/beta/@core/resources/views/frontend/partials/product-wishlist-ajax-js-with-icon.blade.php ENDPATH**/ ?>