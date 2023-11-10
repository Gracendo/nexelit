
<script>
    (function () {
        "use strict";

        $(document).on('click','.ajax_add_to_cart_with_icon_product_slider_addon',function (e) {
            e.preventDefault();
            var allData = $(this).data();
            var el = $(this);
            $.ajax({
                url : "{{route('frontend.products.add.to.cart.ajax')}}",
                type: "POST",
                data: {
                    _token : "{{csrf_token()}}",
                    'product_id' : allData.product_id,
                    'quantity' : allData.product_quantity,
                },
                beforeSend: function(){
                    el.html('<i class="fas fa-spinner fa-spin mr-1"></i> ');
                },
                success: function (data) {
                    el.html('<i class="fa fa-shopping-bag" aria-hidden="true"></i>'+"{{get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')}}");
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
                    el.html('<i class="fas fa-shopping-cart"></i>');
                    $('.home-page-21-cart-icon-top').text(data.total_cart_item);
                    $('.cart_global .pcount').text(data.total_cart_item);
                }
            });
        });


    })(jQuery);
</script>