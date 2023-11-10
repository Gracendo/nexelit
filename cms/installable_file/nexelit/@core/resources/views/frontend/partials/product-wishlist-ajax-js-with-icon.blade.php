
<script>
    (function () {
        "use strict";

        $(document).on('click','.ajax_add_to_wishlist_with_icon',function (e) {

            e.preventDefault();
            var allData = $(this).data();
            var el = $(this);
            $.ajax({
                url : "{{route('frontend.products.add.to.wishlist.ajax')}}",
                type: "POST",
                data: {
                    _token : "{{csrf_token()}}",
                    'product_id' : allData.product_id,
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
                    el.html('<i class="fas fa-heart"></i>');
                    $('.home-page-21-wishlist-icon-top').text(data.total_wishlist_item);
                }
            });
        });


    })(jQuery);
</script>