@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('site_'.get_user_lang().'_title')}} - {{get_static_option('site_'.get_user_lang().'_tag_line')}}
@endsection
@section('page-title')
    {{__('Razorpay Payment')}}
@endsection
@section('style')
    <style>
        .stripe-payment-wrapper form {
            width: 500px;
        }
        .stripe-payment-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100%;
        }
        .stripe-payment-wrapper h1 {
            font-family: var(--heading-font);
            font-size: 40px;
            line-height: 50px;
            width: 500px;
            text-align: center;
            margin-bottom: 40px;
        }

        .srtipe-payment-inner-wrapper {
            box-shadow: 0 0 35px 0 rgba(0,0,0,0.1);
            padding: 40px;
            display: inline-block;
        }

        .srtipe-payment-inner-wrapper label {
            font-size: 16px;
            color: var(--paragraph-color);
            margin-bottom: 10px;
            line-height: 26px;
        }

        .srtipe-payment-inner-wrapper .razorpay-payment-button {
            display: block;
            border: none;
            background-color: var(--main-color-one);
            padding: 13px 30px;
            border-radius: 3px;
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            color: #fff;
            margin-top: 30px;
            cursor: pointer;
            width: 180px;
            margin: 0 auto;
        }
        .srtipe-payment-inner-wrapper .razorpay-payment-button:focus{
            outline: none;
            box-shadow: none;
        }
        .srtipe-payment-inner-wrapper img {
            max-width: 300px;
            margin: 0 auto;
            display: block;
        }
        .srtipe-payment-inner-wrapper .razorpay-payment-button[disabled]{
            background-color: #bdb3b3;cursor: not-allowed;
        }
        .srtipe-payment-inner-wrapper .notice {
            text-align: center;
            color: #d82435;
            margin-bottom: 30px;
            background-color: #ffd0d0;
            padding: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="stripe-payment-wrapper padding-top-120 padding-bottom-120">
        <div class="srtipe-payment-inner-wrapper">
            {!! render_image_markup_by_attachment_id(get_static_option('razorpay_preview_logo')) !!}
            <div class="notice" style="display: none;">{{__('Do not close or reload the page...')}}</div>
                <form action="{{$razorpay_data['route']}}" method="POST" >
                    <!-- Note that the amount is in paise = 50 INR -->
                    <input type="hidden" name="order_id" value="{{$razorpay_data['order_id']}}" />
                    @php
                        $site_logo = get_attachment_image_by_id(get_static_option('site_logo'), "full", false);
                        $image_url = isset($site_logo['img_url']) ? $site_logo['img_url'] : '';
                    @endphp
                    <!--amount need to be in paisa-->
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ get_static_option('razorpay_key') }}"
                            data-currency="{{$razorpay_data['currency']}}"
                            data-amount="{{$razorpay_data['price'] * 100}}"
                            data-buttontext="{{'Pay '.$razorpay_data['price'].' INR'}}"
                            data-name="{{$razorpay_data['package_name']}}"
                            data-description="{{__('Payment For '.$razorpay_data['package_name'])}}"
                            data-image="{{$image_url}}"
                            data-prefill.name=""
                            data-prefill.email=""
                            data-theme.color="{{get_static_option('site_color')}}">
                    </script>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            $(document).on('click','.razorpay-payment-button',function (e){
                var submitBtn = $(this);
                // submitBtn.attr('disabled',true);
                submitBtn.val('Please Wait...');
                $('.notice').css('display','block');
            });

        });
    </script>
@endsection
