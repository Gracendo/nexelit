@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('Wishlist')}}
@endsection
@section('page-title')
    {{__('Wishlist')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
@endsection
@section('content')
    <section class="product-content-area padding-top-120 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('backend.partials.message')
                   <div class="cart-wrapper">
                       <div class="wishlist-table-wrapper">
                           {!! \App\Facades\Wishlist::wishlistTable()!!}
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('assets/frontend/js/toastr.min.js')}}"></script>
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
                   url: "{{route('frontend.products.wishlist.ajax.remove')}}",
                   type: "POST",
                   data: {
                       _token : "{{csrf_token()}}",
                       cart_index : cart_index
                   },
                    beforeSend: function(){
                        el.next('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                   success:function (data) {
                       el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                       $('.pcount home-page-21-wishlist-icon-top').text(data.total_cart_item);
                       $('.wishlist-table-wrapper').html(data.cart_table_markup);
                       var msg = "{{__('Wishlist Item Removed')}}";
                       toastr.error(msg);
                   }
                });
            });

        })(jQuery);
    </script>
@endsection
