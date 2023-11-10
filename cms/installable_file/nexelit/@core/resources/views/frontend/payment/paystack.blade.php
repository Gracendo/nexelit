@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('site_'.get_default_language().'_title')}} - {{get_static_option('site_'.get_default_language().'_tag_line')}}
@endsection
@section('page-title')
    {{__('PayStack Payment')}}
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
            margin-top: 30px;
            background-color: #ffd0d0;
            padding: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="stripe-payment-wrapper padding-top-120 padding-bottom-120">
        <div class="srtipe-payment-inner-wrapper">
            {!! render_image_markup_by_attachment_id(get_static_option('paystack_preview_logo')) !!}
            <div class="notice" style="display: none;">{{__('Do not close or reload the page...')}}</div>
            <form method="POST" action="{{ $paystack_data['route'] }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <input type="hidden" name="name" value="{{$paystack_data['name']}}">
                        <input type="hidden" name="email" value="{{$paystack_data['email']}}"> {{-- required --}}
                        <input type="hidden" name="order_id" value="{{$paystack_data['order_id']}}">
                        <input type="hidden" name="orderID" value="{{$paystack_data['order_id']}}">
                        <input type="hidden" name="amount" value="{{$paystack_data['price'] * 100}}"> {{-- required in kobo --}}
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="currency" value="{{$paystack_data['currency']}}">
                        <input type="hidden" name="metadata" value="{{ json_encode($array = ['track' => $paystack_data['track'],'type' => $paystack_data['type']]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                        <p>
                            <button class="btn btn-success btn-lg btn-block paystack-btn margin-top-30" type="submit" value="Pay Now!">
                                {{'Pay'}} {{$paystack_data['price'].get_charge_currency('paystack')}} {{ __(' Now!')}}
                            </button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            $(document).on('click','.paystack-btn',function (e){
                var submitBtn = $(this);
                submitBtn.text('Please Wait...');
                $('.notice').css('display','block');
            });

        });
    </script>
@endsection

