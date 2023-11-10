@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('site_'.get_user_lang().'_title')}} - {{get_static_option('site_'.get_user_lang().'_tag_line')}}
@endsection
@section('page-title')
    {{__('Flutterwave Payment')}}
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
        input.submit-btn {
            display: inline-block;
            background-color: var(--main-color-one);
            padding: 10px 40px;
            width: auto;
            color: #fff;
        }

        input.submit-btn:hover {
            background-color: var(--main-color-two);
            color: #fff;
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
            {!! render_image_markup_by_attachment_id(get_static_option('flutterwave_preview_logo')) !!}
            <div class="notice" style="display: none;">{{__('Do not close or reload the page...')}}</div>
            <form method="POST" action="{{$flutterwave_data['form_action']}}" id="paymentForm">
                {{ csrf_field() }}
                <input type="hidden" name="amount" value="{{$flutterwave_data['amount']}}" /> <!-- Replace the value with your transaction amount -->
                <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
                <input type="hidden" name="description" value="{{$flutterwave_data['description']}}" /> <!-- Replace the value with your transaction description -->
                <input type="hidden" name="country" value="{{$flutterwave_data['country']}}" /> <!-- Replace the value with your transaction country -->
                <input type="hidden" name="currency" value="{{$flutterwave_data['currency']}}" /> <!-- Replace the value with your transaction currency -->
                <input type="hidden" name="email" value="{{$flutterwave_data['email']}}" /> <!-- Replace the value with your customer email -->
                <input type="hidden" name="firstname" value="{{$flutterwave_data['name']}}" /> <!-- Replace the value with your customer firstname -->
{{--                <input type="hidden" name="lastname" value="Adebiyi" /> <!-- Replace the value with your customer lastname -->--}}
                <input type="hidden" name="metadata" value="{{ json_encode($flutterwave_data['metadata']) }}" > <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
{{--                <input type="hidden" name="phonenumber" value="090929992892" /> <!-- Replace the value with your customer phonenumber -->--}}
                <div class="btn-wrapper text-center">
                    <input type="submit" class="submit-btn" value="{{__('Pay')}} {{$flutterwave_data['amount'].$flutterwave_data['currency']}} {{ __('Now')}}"  />
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function (){
            $(document).on('click','.submit-btn',function (e){
                var submitBtn = $(this);
                // submitBtn.attr('disabled',true);
                submitBtn.val('Please Wait...');
                $('.notice').css('display','block');
            });

        });
    </script>
@endsection
