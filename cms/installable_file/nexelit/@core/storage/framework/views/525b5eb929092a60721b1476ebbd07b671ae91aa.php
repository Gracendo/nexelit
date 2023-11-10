
<script>
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    (function ($) {
        "use strict";

        var allProgress = $('.donation-progress');
        $.each(allProgress, function (index, value) {
            $(this).rProgressbar({
                percentage: $(this).data('percent'),
                fillBackgroundColor: "<?php echo e(get_static_option('site_color')); ?>"
            });
        })

        <?php if(!empty(get_static_option('site_sticky_navbar_enabled'))): ?>
        $(window).on('scroll', function () {

            if ($(window).width() > 992) {
                /*--------------------------
                sticky menu activation
               -------------------------*/
                var st = $(this).scrollTop();
                var mainMenuTop = $('.navbar-area');
                if ($(window).scrollTop() > 1000) {
                    // active sticky menu on scrollup
                    mainMenuTop.addClass('nav-fixed');
                } else {
                    mainMenuTop.removeClass('nav-fixed ');
                }
            }
        });
        <?php endif; ?>
        $(document).on('change', '.search-form-warp', function (e) {
            e.preventDefault();
            var el = $(this);
            var searchType = $('#search_popup_search_type').val();
            if (searchType == 'blog') {
                el.attr('action', "<?php echo e(route('frontend.blog.search')); ?>");
                el.find('.search-field').attr('name', 'search');
            } else if (searchType == 'event') {
                el.attr('action', "<?php echo e(route('frontend.events.search')); ?>");
                el.find('.search-field').attr('name', 'search');
            } else if (searchType == 'knowledgebase') {
                el.attr('action', "<?php echo e(route('frontend.knowledgebase.search')); ?>");
                el.find('.search-field').attr('name', 'search');
            } else if (searchType == 'product') {
                el.attr('action', "<?php echo e(route('frontend.products')); ?>");
                el.find('.search-field').attr('name', 'q');
            }

        });
        $(document).on('change', '#langchange', function (e) {
            $.ajax({
                url: "<?php echo e(route('frontend.langchange')); ?>",
                type: "GET",
                data: {
                    'lang': $(this).val()
                },
                success: function (data) {
                    window.location = "<?php echo e(route('homepage')); ?>";
                }
            })
        });
        $(document).on('click', '.newsletter-form-wrap .submit-btn', function (e) {
            e.preventDefault();
            var email = $('.newsletter-form-wrap input[type="email"]').val();
            $('.newsletter-widget .form-message-show').html('');

            $.ajax({
                url: "<?php echo e(route('frontend.subscribe.newsletter')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    email: email
                },
                success: function (data) {
                    $('.newsletter-widget .form-message-show').html('<div class="alert alert-success">' + data + '</div>');
                },
                error: function (data) {
                    var errors = data.responseJSON.errors;
                    $('.newsletter-widget .form-message-show').html('<div class="alert alert-danger">' + errors.email[0] + '</div>');
                }
            });
        });

        $(document).on('submit', '.custom-form-builder-form', function (e) {
            e.preventDefault();
            var form = $(this);
            var formID = form.attr('id');
            var msgContainer =  form.find('.error-message');
            var formSelector = document.getElementById(formID);
            var formData = new FormData(formSelector);
            msgContainer.html('');
            $.ajax({
                url: "<?php echo e(route('frontend.form.builder.custom.submit')); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                },
                beforeSend:function (){
                    form.find('.ajax-loading-wrap').addClass('show').removeClass('hide');
                },
                processData: false,
                contentType: false,
                data:formData,
                success: function (data) {
                    form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                    msgContainer.html('<div class="alert alert-'+data.type+'">' + data.msg + '</div>');
                },
                error: function (data) {
                    form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                    var errors = data.responseJSON.errors;
                    var markup = '<ul class="alert alert-danger">';
                    $.each(errors,function (index,value){
                        markup += '<li>'+value+'</li>';
                    })
                    markup += '</ul>';
                    msgContainer.html(markup);
                }
            });
        });

    }(jQuery));
</script>



<?php echo $__env->make('frontend.partials.custom-js-for-page-builder-addon.product-slider.product-ajax-js-with-icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.custom-js-for-page-builder-addon.product-slider.product-wishlist-ajax-js-with-icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.custom-js-for-page-builder-addon.product-slider.quick-view-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.custom-js-for-page-builder-addon.product-slider.quick-view-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('frontend.partials.product-ajax-js-with-icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.product-wishlist-ajax-js-with-icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script>
    $(document).on('click','.product-variant-list li',function (){
        $(this).addClass('selected').siblings().removeClass('selected');
        var price = $(this).data('price');
        var termprice = $(this).data('termprice');
        $('.quick_view_sale_price').text(termprice);
        var allSelectedValue = $('.product-variant-list li.selected');
        var variantVal = [];
        $.each(allSelectedValue,function (index,value){
            var elData = $(this).data();
            variantVal.push({
                'variantID' : elData.variantid,
                'variantName' : elData.variantname,
                'term' : elData.term,
                'price' :  elData.price =! 'undefined' ? elData.price : '',
            })
        });

        $(".add_cart_from_quick_view").attr("data-selected-variant", JSON.stringify(variantVal))
        $('input[name="product_variants"]').val(JSON.stringify(variantVal));
    });

    $(document).on('click','.add_cart_from_quick_view',function (e){
        e.preventDefault();
        
        var variants = $('.product-variant-list').length;
        var variantSelected = $('.product-variant-list li.selected').length;
     
        if(variants != variantSelected){
            $(this).parent().parent().append('<br><p class="text-danger"><?php echo e(__('Select Product Variants')); ?></p>');
        }else {
            hit_ajax_for_add_to_cart(this);
        }
    });


    function hit_ajax_for_add_to_cart(element){
        var allData = $(element).data();
        var el = $(element);
        $.ajax({
            url : "<?php echo e(route('frontend.products.add.to.cart')); ?>",
            type: "POST",
            data: {
                _token : "<?php echo e(csrf_token()); ?>",
                'product_id' : allData.product_id,
                'quantity' : allData.product_quantity,
                'product_variants' : $(element).attr("data-selected-variant")
            },
            beforeSend: function(){
                el.text("<?php echo e(__('Adding')); ?>");
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
                toastr.success('Product added to cart');
                $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount').text(data.total_cart_item);
            }
        });
    }
</script><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/partials/inline-script.blade.php ENDPATH**/ ?>