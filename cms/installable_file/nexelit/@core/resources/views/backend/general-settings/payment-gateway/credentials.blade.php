<div class="accordion-wrapper">
    <div id="accordion-payment">
        <div class="card">
            <div class="card-header" id="paypal_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#paypal_settings_content"
                            aria-expanded="true">
                        <span class="page-title"> {{__('Paypal Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="paypal_settings_content" class="collapse show"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p>{{__('if your currency is not available in paypal, it will convert you currency value to USD value based on your currency exchange rate.')}}</p>
                    </div>
                    <div class="form-group">
                        <label for="paypal_gateway"><strong>{{__('Enable Paypal')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paypal_gateway"
                                   @if(!empty(get_static_option('paypal_gateway'))) checked
                                   @endif id="paypal_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paypal_test_mode"><strong>{{__('Enable Test Mode For Paypal')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paypal_test_mode"
                                   @if(!empty(get_static_option('paypal_test_mode'))) checked @endif >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong>{{__('Paypal Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paypal_img = get_attachment_image_by_id(get_static_option('paypal_preview_logo'),null,true);
                                    $paypal_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paypal_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="{{$paypal_img['img_url']}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paypal_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="paypal_preview_logo"
                                   name="paypal_preview_logo"
                                   value="{{get_static_option('paypal_preview_logo')}}">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="{{__('Select Image')}}"
                                    data-modaltitle="{{__('Upload Image')}}"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                {{__($paypal_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>



                    <div class="form-group">
                        <label for="paypal_sandbox_client_id">{{__('Paypal Sandbox Client ID')}}</label>
                        <input type="text" name="paypal_sandbox_client_id"
                               class="form-control"
                               value="{{get_static_option('paypal_sandbox_client_id')}}">
                    </div>
                    <div class="form-group">
                        <label for="paypal_sandbox_client_secret">{{__('Paypal Sandbox Client Secret')}}</label>
                        <input type="text" name="paypal_sandbox_client_secret"
                               class="form-control"
                               value="{{get_static_option('paypal_sandbox_client_secret')}}">
                    </div>

                    <div class="form-group">
                        <label for="paypal_sandbox_app_id">{{__('Paypal Sandbox App ID')}}</label>
                        <input type="text" name="paypal_sandbox_app_id"
                               class="form-control"
                               value="{{get_static_option('paypal_sandbox_app_id')}}">
                    </div>

                    <div class="form-group">
                        <label for="paypal_live_client_id">{{__('Paypal Live Client ID')}}</label>
                        <input type="text" name="paypal_live_client_id"
                               class="form-control"
                               value="{{get_static_option('paypal_live_client_id')}}">
                    </div>
                    <div class="form-group">
                        <label for="paypal_live_client_secret">{{__('Paypal Live Client Secret')}}</label>
                        <input type="text" name="paypal_live_client_secret"
                               class="form-control"
                               value="{{get_static_option('paypal_live_client_secret')}}">
                    </div>


                    <div class="form-group">
                        <label for="paypal_live_app_id">{{__('Paypal Live App ID')}}</label>
                        <input type="text" name="paypal_live_app_id"
                               class="form-control"
                               value="{{get_static_option('paypal_live_app_id')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="paytm_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#paytm_settings_content"
                            aria-expanded="false">
                        <span class="page-title"> {{__('Paytm Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="paytm_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <div class="payment-notice alert alert-warning">

                            <p>{{__('if your currency is not available in paytm, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                        </div>
                        <label for="paytm_gateway"><strong>{{__('Enable/Disable Paytm')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paytm_gateway"
                                   @if(!empty(get_static_option('paytm_gateway'))) checked
                                   @endif id="paytm_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong>{{__('Enable Test Mode For Paytm')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paytm_test_mode"
                                   @if(!empty(get_static_option('paytm_test_mode'))) checked
                                    @endif >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong>{{__('Paytm Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('paytm_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paytm_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="{{$paytm_img['img_url']}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paytm_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="paytm_preview_logo"
                                   name="paytm_preview_logo"
                                   value="{{get_static_option('paytm_preview_logo')}}">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="{{__('Select Image')}}"
                                    data-modaltitle="{{__('Upload Image')}}"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                {{__($paytm_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('Paytm Merchant Key')}}</label>
                        <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" value="{{get_static_option('paytm_merchant_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_mid">{{__('Paytm Merchant ID')}}</label>
                        <input type="text" name="paytm_merchant_mid" id="paytm_merchant_mid"  value="{{get_static_option('paytm_merchant_mid')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_website">{{__('Paytm Merchant Website')}}</label>
                        <input type="text" name="paytm_merchant_website" id="paytm_merchant_website"  value="{{get_static_option('paytm_merchant_website')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_channel">{{__('Paytm channel')}}</label>
                        <input type="text" name="paytm_channel" value="{{get_static_option('paytm_channel')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_industry_type">{{__('Paytm Industry Type')}}</label>
                        <input type="text" name="paytm_industry_type" value="{{get_static_option('paytm_industry_type')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="stripe_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#stripe_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Stripe Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="stripe_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                    </div>
                    <div class="form-group">
                        <label for="stripe_gateway"><strong>{{__('Enable/Disable Stripe')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="stripe_gateway"  @if(!empty(get_static_option('stripe_gateway'))) checked @endif id="stripe_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="stripe_gateway"><strong>{{__('Enable/Disable Stripe Test Mode')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="stripe_test_mode"  @if(!empty(get_static_option('stripe_test_mode'))) checked @endif id="stripe_test_mode">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="stripe_logo"><strong>{{__('Stripe Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $stripe_img = get_attachment_image_by_id(get_static_option('stripe_preview_logo'),null,true);
                                    $stripe_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($stripe_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$stripe_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $stripe_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="stripe_preview_logo" name="stripe_preview_logo" value="{{get_static_option('stripe_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($stripe_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="stripe_public_key">{{__('Stripe Public Key')}}</label>
                        <input type="text" name="stripe_public_key" id="stripe_public_key" value="{{get_static_option('stripe_public_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stripe_secret_key">{{__('Stripe Secret')}}</label>
                        <input type="text" name="stripe_secret_key" id="stripe_secret_key"  value="{{get_static_option('stripe_secret_key')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="razorpay_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#razorpay_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Razorpay Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="razorpay_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p>{{__("Available Currency For Razorpay is, ['INR']")}}</p>
                        <p>{{__('if your currency is not available in Razorpay, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_gateway"><strong>{{__('Enable/Disable Razorpay')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="razorpay_gateway"  @if(!empty(get_static_option('razorpay_gateway'))) checked @endif id="razorpay_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_gateway"><strong>{{__('Enable/Disable Razorpay Test Mode')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="razorpay_test_mode"  @if(!empty(get_static_option('razorpay_test_mode'))) checked @endif id="razorpay_test_mode">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_logo"><strong>{{__('Razorpay Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $razorpay_img = get_attachment_image_by_id(get_static_option('razorpay_preview_logo'),null,true);
                                    $razorpay_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($razorpay_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$razorpay_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $razorpay_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="razorpay_preview_logo" name="razorpay_preview_logo" value="{{get_static_option('razorpay_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($razorpay_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_api_key">{{__('Razorpay Key')}}</label>
                        <input type="text" name="razorpay_api_key" id="razorpay_api_key" value="{{get_static_option('razorpay_api_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="razorpay_api_secret">{{__('Razorpay Secret')}}</label>
                        <input type="text" name="razorpay_api_secret" id="razorpay_api_secret"  value="{{get_static_option('razorpay_api_secret')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="paystack_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#paystack_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('PayStack Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="paystack_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">

                        <p>{{__('if your currency is not available in Paystack, it will convert you currency value to NGN value based on your currency exchange rate.')}}</p>
                    </div>
                    <p class="margin-bottom-30 margin-top-20 info-paragraph">
                        {{__('Don\'t forget to put below url to "Settings > API Key & Webhook > Callback URL" in your paystack admin panel')}}
                        <input type="text" class="info-url" value="{{route('frontend.paystack.ipn')}}">
                    </p>
                    <div class="form-group">
                        <label for="paystack_gateway"><strong>{{__('Enable/Disable PayStack')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paystack_gateway"  @if(!empty(get_static_option('paystack_gateway'))) checked @endif id="paystack_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paystack_gateway"><strong>{{__('Enable/Disable PayStack Test Mode')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paystack_test_mode"  @if(!empty(get_static_option('paystack_test_mode'))) checked @endif id="paystack_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paystack_preview_logo"><strong>{{__('PayStack Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paystack_img = get_attachment_image_by_id(get_static_option('paystack_preview_logo'),null,true);
                                    $paystack_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paystack_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$paystack_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paystack_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="paystack_preview_logo" name="paystack_preview_logo" value="{{get_static_option('paystack_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($paystack_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="paystack_public_key">{{__('PayStack Public Key')}}</label>
                        <input type="text" name="paystack_public_key" id="paystack_public_key" value="{{get_static_option('paystack_public_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paystack_secret_key">{{__('PayStack Secret Key')}}</label>
                        <input type="text" name="paystack_secret_key" id="paystack_secret_key"  value="{{get_static_option('paystack_secret_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paystack_merchant_email">{{__('PayStack Merchant Email')}}</label>
                        <input type="text" name="paystack_merchant_email" id="paystack_merchant_email"  value="{{get_static_option('paystack_merchant_email')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="mollie_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mollie_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Mollie Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="mollie_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p>{{__("Available Currency For Mollie is, ['AED','AUD','BGN','BRL','CAD','CHF','CZK','DKK','EUR','GBP','HKD','HRK','HUF','ILS','ISK','JPY','MXN','MYR','NOK','NZD','PHP','PLN','RON','RUB','SEK','SGD','THB','TWD','USD','ZAR']")}}</p>
                        <p>{{__('if your currency is not available in mollie, it will convert you currency value to USD value based on your currency exchange rate.')}}</p>
                    </div>
                    <div class="form-group">
                        <label for="mollie_gateway"><strong>{{__('Enable/Disable Mollie')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="mollie_gateway"  @if(!empty(get_static_option('mollie_gateway'))) checked @endif id="mollie_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="mollie_gateway"><strong>{{__('Enable/Disable Mollie Test Mode')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="mollie_test_mode"  @if(!empty(get_static_option('mollie_test_mode'))) checked @endif id="mollie_test_mode">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="mollie_preview_logo"><strong>{{__('Mollie Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $mollie_img = get_attachment_image_by_id(get_static_option('mollie_preview_logo'),null,true);
                                    $mollie_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($mollie_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$mollie_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $mollie_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="mollie_preview_logo" name="mollie_preview_logo" value="{{get_static_option('mollie_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="mollie_public_key">{{__('Mollie Public Key')}}</label>
                        <input type="text" name="mollie_public_key" id="mollie_public_key" value="{{get_static_option('mollie_public_key')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="flluterwave_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#flutterwave_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Flutterwave Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="flutterwave_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p>{{__("Available Currency For Flutterwave is, ['BIF','CAD','CDF','CVE','EUR','GBP','GHS','GMD','GNF','KES','LRD','MWK','MZN','NGN','RWF','SLL','STD','TZS','UGX','USD','XAF','XOF','ZMK','ZMW','ZWD']")}}</p>
                        <p>{{__('if your currency is not available in flutterwave, it will convert you currency value to USD value based on your currency exchange rate.')}}</p>
                    </div>
                    <div class="form-group">
                        <label for="flutterwave_gateway"><strong>{{__('Enable/Disable Flutterwave')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="flutterwave_gateway"  @if(!empty(get_static_option('flutterwave_gateway'))) checked @endif id="flutterwave_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="flutterwave_test_mode"><strong>{{__('Enable Test Mode Flutterwave')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="flutterwave_test_mode" @if(!empty(get_static_option('flutterwave_test_mode'))) checked @endif>
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="flutterwave_preview_logo"><strong>{{__('Flutterwave Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $mollie_img = get_attachment_image_by_id(get_static_option('flutterwave_preview_logo'),null,true);
                                    $mollie_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($mollie_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$mollie_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $mollie_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="flutterwave_preview_logo" name="flutterwave_preview_logo" value="{{get_static_option('flutterwave_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="flw_public_key">{{__('Flutterwave Public Key')}}</label>
                        <input type="text" name="flw_public_key" id="flw_public_key" value="{{get_static_option('flw_public_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="flw_secret_key">{{__('Flutterwave Secret Key')}}</label>
                        <input type="text" name="flw_secret_key" id="flw_secret_key" value="{{get_static_option('flw_secret_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="flw_secret_hash">{{__('Flutterwave Secret Hash')}}</label>
                        <input type="text" name="flw_secret_hash" id="flw_secret_hash" value="{{get_static_option('flw_secret_hash')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="midtrans_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#midtrans_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('MIdtranse Settings')}}</span>
                    </button>
                </h5>
            </div>

            <div id="midtrans_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="flutterwave_gateway"><strong>{{__('Enable/Disable Flutterwave')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="midtrans_gateway"  @if(!empty(get_static_option('midtrans_gateway'))) checked @endif id="flutterwave_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="midtrans_test_mode"><strong>{{__('Enable Test Mode Midtranse')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="midtrans_test_mode" @if(!empty(get_static_option('midtrans_test_mode'))) checked @endif>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong>{{__('Midtranse Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $midtrans_img = get_attachment_image_by_id(get_static_option('midtrans_preview_logo'),null,true);
                                    $midtrans_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($midtrans_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$midtrans_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $midtrans_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="midtrans_preview_logo" name="midtrans_preview_logo" value="{{get_static_option('midtrans_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="midtrans_merchant_id">{{__('Midtranse Merchant ID')}}</label>
                        <input type="text" name="midtrans_merchant_id" id="midtrans_merchant_id" value="{{get_static_option('midtrans_merchant_id')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_server_key">{{__('Midtranse Server Key')}}</label>
                        <input type="text" name="midtrans_server_key" id="midtrans_server_key" value="{{get_static_option('midtrans_server_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_client_key">{{__('Midtranse Client Key')}}</label>
                        <input type="text" name="midtrans_client_key" id="midtrans_client_key" value="{{get_static_option('midtrans_client_key')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="payfast_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#payfast_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Payfast Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="payfast_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="payfast_gateway"><strong>{{__('Enable/Disable Payfast')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="payfast_gateway"  @if(!empty(get_static_option('payfast_gateway'))) checked @endif id="payfast_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="payfast_test_mode"><strong>{{__('Enable Test Mode Payfast')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="payfast_test_mode" @if(!empty(get_static_option('payfast_test_mode'))) checked @endif>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong>{{__('Payfast Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $payfast_img = get_attachment_image_by_id(get_static_option('payfast_preview_logo'),null,true);
                                    $payfast_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($midtrans_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$payfast_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $payfast_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="payfast_preview_logo" name="payfast_preview_logo" value="{{get_static_option('payfast_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="midtrans_merchant_id">{{__('Payfast Merchant ID')}}</label>
                        <input type="text" name="payfast_merchant_id" id="payfast_merchant_id" value="{{get_static_option('payfast_merchant_id')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_server_key">{{__('Payfast Merchant Key')}}</label>
                        <input type="text" name="payfast_merchant_key" id="payfast_merchant_key" value="{{get_static_option('payfast_merchant_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_client_key">{{__('Payfast Passphrase')}}</label>
                        <input type="text" name="payfast_passphrase" id="payfast_passphrase" value="{{get_static_option('payfast_passphrase')}}" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="midtrans_environment">{{__('Payfast ITN URL')}}</label>
                        <input type="text" name="payfast_itn_url" id="payfast_itn_url" value="{{get_static_option('payfast_itn_url')}}" class="form-control">
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="cashfree_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#cashfree_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Cashfree Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="cashfree_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="cashfree_gateway"><strong>{{__('Enable/Disable Cashfree')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cashfree_gateway"  @if(!empty(get_static_option('cashfree_gateway'))) checked @endif id="cashfree_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="cashfree_test_mode"><strong>{{__('Enable Test Mode Cashfree')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cashfree_test_mode" @if(!empty(get_static_option('cashfree_test_mode'))) checked @endif>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong>{{__('Cashfree Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $cashfree_img = get_attachment_image_by_id(get_static_option('cashfree_preview_logo'),null,true);
                                    $cashfree_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($midtrans_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$cashfree_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $cashfree_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="cashfree_preview_logo" name="cashfree_preview_logo" value="{{get_static_option('cashfree_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>

                    <div class="form-group">
                        <label for="cashfree_app_id">{{__('Cashfree App ID')}}</label>
                        <input type="text" name="cashfree_app_id" id="cashfree_app_id" value="{{get_static_option('cashfree_app_id')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cashfree_secret_key">{{__('Cashfree Secret Key')}}</label>
                        <input type="text" name="cashfree_secret_key" id="cashfree_secret_key" value="{{get_static_option('cashfree_secret_key')}}" class="form-control">
                    </div>


                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="instamojo_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#instamojo_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Instamojo Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="instamojo_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="instamojo_gateway"><strong>{{__('Enable/Disable Instamojo')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="instamojo_gateway"  @if(!empty(get_static_option('instamojo_gateway'))) checked @endif id="instamojo_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="instamojo_test_mode"><strong>{{__('Enable Test Mode Instamojo')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="instamojo_test_mode" @if(!empty(get_static_option('instamojo_test_mode'))) checked @endif>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong>{{__('Instamojo Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $instamojo_img = get_attachment_image_by_id(get_static_option('instamojo_preview_logo'),null,true);
                                    $instamojo_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($midtrans_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$instamojo_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $instamojo_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="instamojo_preview_logo" name="instamojo_preview_logo" value="{{get_static_option('instamojo_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="instamojo_client_id">{{__('Instamojo Client ID')}}</label>
                        <input type="text" name="instamojo_client_id" id="instamojo_client_id" value="{{get_static_option('instamojo_client_id')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="instamojo_client_secret">{{__('Instamojo Client Secret')}}</label>
                        <input type="text" name="instamojo_client_secret" id="instamojo_client_secret" value="{{get_static_option('instamojo_client_secret')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="instamojo_username">{{__('Instamojo Username')}}</label>
                        <input type="text" name="instamojo_username" id="instamojo_username" value="{{get_static_option('instamojo_username')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="instamojo_password">{{__('Instamojo Password')}}</label>
                        <input type="text" name="instamojo_password" id="instamojo_password" value="{{get_static_option('instamojo_password')}}" class="form-control">
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="marcado_pago_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#marcado_pago_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Marcado Pago Settings')}}</span>
                    </button>
                </h5>
            </div>



            <div id="marcado_pago_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="marcadopago_gateway"><strong>{{__('Enable/Disable Marcado Pago')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="marcadopago_gateway"  @if(!empty(get_static_option('marcadopago_gateway'))) checked @endif id="marcadopago_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="marcadopago_test_mode"><strong>{{__('Enable Test Mode Marcado Pago')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="marcadopago_test_mode" @if(!empty(get_static_option('marcadopago_test_mode'))) checked @endif>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="marcadopago_preview_logo"><strong>{{__('Marcado Pago gateway Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $marcadopago_img = get_attachment_image_by_id(get_static_option('marcadopago_preview_logo'),null,true);
                                    $marcadopago_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($midtrans_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$marcadopago_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $marcadopago_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="marcadopago_preview_logo" name="marcadopago_preview_logo" value="{{get_static_option('marcadopago_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>

                    <div class="form-group">
                        <label for="marcado_pago_client_id">{{__('Marcado Pago Client ID')}}</label>
                        <input type="text" name="marcado_pago_client_id" id="marcado_pago_client_id" value="{{get_static_option('marcado_pago_client_id')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="marcado_pago_client_secret">{{__('Marcedo Pago Client Secret')}}</label>

                        <input type="text" name="marcado_pago_client_secret" id="marcado_pago_client_secret" value="{{get_static_option('marcado_pago_client_secret')}}" class="form-control">
                    </div>

                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header" id="squareup_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#squareup_settings_settings_content" aria-expanded="false" >
                        <span class="page-title"> {{__('Squareup Settings')}}</span>
                    </button>
                </h5>
            </div>


            <div id="squareup_settings_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <label for="marcadopago_gateway"><strong>{{__('Enable/Disable Squareup')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="squareup_gateway"  @if(!empty(get_static_option('squareup_gateway'))) checked @endif id="squareup_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="marcadopago_test_mode"><strong>{{__('Enable Test Mode Squareup')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="squareup_test_mode" @if(!empty(get_static_option('squareup_test_mode'))) checked @endif>
                            <span class="slider onff"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="marcadopago_preview_logo"><strong>{{__('Squareup gateway Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $marcadopago_img = get_attachment_image_by_id(get_static_option('squareup_preview_logo'),null,true);
                                    $marcadopago_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($midtrans_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{$marcadopago_img['img_url']}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $marcadopago_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="squareup_preview_logo" name="squareup_preview_logo" value="{{get_static_option('squareup_preview_logo')}}">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                {{__($mollie_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>

                    <div class="form-group">
                        <label for="marcado_pago_client_id">{{__('Squareup Access Token')}}</label>
                        <input type="text" name="squareup_access_token" id="squareup_access_token" value="{{get_static_option('squareup_access_token')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="marcado_pago_client_secret">{{__('Squareup Location ID')}}</label>
                        <input type="text" name="squareup_location_id" id="squareup_location_id" value="{{get_static_option('squareup_location_id')}}" class="form-control">
                    </div>

                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header" id="cinetpay_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#cinetpay_settings_content"
                            aria-expanded="false">
                        <span class="page-title"> {{__('Cinetpay Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="cinetpay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <div class="payment-notice alert alert-warning">
                            <p>{{__('if your currency is not available in cinetpay, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                        </div>
                        <label for="paytm_gateway"><strong>{{__('Enable/Disable Cinetpay')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cinetpay_gateway"
                                   @if(!empty(get_static_option('cinetpay_gateway'))) checked
                                   @endif id="cinetpay_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong>{{__('Enable Test Mode For Cinetpay')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cinetpay_test_mode"
                                   @if(!empty(get_static_option('cinetpay_test_mode'))) checked
                                    @endif >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong>{{__('Cinetpay Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('cinetpay_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paytm_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="{{$paytm_img['img_url']}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paytm_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="cinetpay_preview_logo"
                                   name="cinetpay_preview_logo"
                                   value="{{get_static_option('cinetpay_preview_logo')}}">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="{{__('Select Image')}}"
                                    data-modaltitle="{{__('Upload Image')}}"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                {{__($paytm_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('Cinetpay Api Key')}}</label>
                        <input type="text" name="cinetpay_api_key" id="cinetpay_api_key" value="{{get_static_option('cinetpay_api_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_mid">{{__('Cinetpay Site ID')}}</label>
                        <input type="text" name="cinetpay_site_id" id="cinetpay_site_id"  value="{{get_static_option('cinetpay_site_id')}}" class="form-control">
                    </div>

                </div>
            </div>
        </div>
        
        
     
        
        
        
        
        
       <div class="card">
           <div class="card-header" id="bill_plz_settings">
              <h5 class="mb-0">
                 <button class="btn btn-link" type="button"
                           data-toggle="collapse"
                          data-target="#bill_plz_settings_content"
                           aria-expanded="false">
                      <span class="page-title"> {{__('BillPlz Settings')}}</span>
                   </button>
               </h5>
            </div>
            <div id="bill_plz_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                            <div class="payment-notice alert alert-warning">
                            <p>{{__('if your currency is not available in Billplz, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                        </div>
                        <label for="paytm_gateway"><strong>{{__('Enable/Disable BillPlz')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="billplz_gateway"
                                   @if(!empty(get_static_option('billplz_gateway')))
                                    checked
                                   @endif id="billplz_gateway">
                            <span class="slider onff"></span>-
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong>{{__('Enable Test Mode For BillPlz')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="billplz_test_mode"
                                   @if(!empty(get_static_option('billplz_test_mode'))) checked
                                    @endif >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong>{{__('BillPlz Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('billplz_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paytm_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="{{$paytm_img['img_url']}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paytm_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="billplz_preview_logo"
                                   name="billplz_preview_logo"--}}
                                   value="{{get_static_option('billplz_preview_logo')}}">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="{{__('Select Image')}}"
                                    data-modaltitle="{{__('Upload Image')}}"
                                    data-toggle="modal"--}}
                                    data-target="#media_upload_modal">
                                {{__($paytm_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('BillPlz Key')}}</label>
                        <input type="text" name="billplz_key" id="billplz_key" value="{{get_static_option('billplz_key')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('BillPlz Version')}}</label>
                        <input type="text" name="billplz_version" id="billplz_version" value="{{get_static_option('billplz_version')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('BillPlz X-Signature')}}</label>
                        <input type="text" name="billplz_x_signature" id="billplz_x_signature" value="{{get_static_option('billplz_x_signature')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('BillPlz Collection Name')}}</label>
                        <input type="text" name="billplz_collection_name" id="billplz_x_signature" value="{{get_static_option('billplz_collection_name')}}" class="form-control">
                    </div>

                </div>
            </div>


        <div class="card">
           <div class="card-header" id="bill_plz_settings">
              <h5 class="mb-0">
                 <button class="btn btn-link" type="button"
                           data-toggle="collapse"
                          data-target="#zitopay_settings_content"
                           aria-expanded="false">
                      <span class="page-title"> {{__('Zitopay Settings')}}</span>
                   </button>
               </h5>
            </div>
            <div id="zitopay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                            <div class="payment-notice alert alert-warning">
                            <p>{{__('if your currency is not available in Zitopay, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                        </div>
                        <label for="paytm_gateway"><strong>{{__('Enable/Disable Zitopay')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="zitopay_gateway"
                                   @if(!empty(get_static_option('zitopay_gateway')))
                                    checked
                                   @endif id="zitopay_gateway">
                            <span class="slider onff"></span>-
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong>{{__('Enable Test Mode For Zitopay')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="zitopay_test_mode"
                                   @if(!empty(get_static_option('zitopay_test_mode'))) checked
                                    @endif >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong>{{__('Zitopay Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('zitopay_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paytm_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="{{$paytm_img['img_url']}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paytm_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="zitopay_preview_logo"
                                   name="zitopay_preview_logo"--}}
                                   value="{{get_static_option('zitopay_preview_logo')}}">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="{{__('Select Image')}}"
                                    data-modaltitle="{{__('Upload Image')}}"
                                    data-toggle="modal"--}}
                                    data-target="#media_upload_modal">
                                {{__($paytm_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('Zitopay User Name')}}</label>
                        <input type="text" name="zitopay_username" id="zitopay_username" value="{{get_static_option('zitopay_username')}}" class="form-control">
                    </div>
                </div>
            </div>

        <div class="card">
           <div class="card-header" id="bill_plz_settings">
              <h5 class="mb-0">
                 <button class="btn btn-link" type="button"
                           data-toggle="collapse"
                          data-target="#toyyibpay_settings_content"
                           aria-expanded="false">
                      <span class="page-title"> {{__('Toyyibpay Settings')}}</span>
                   </button>
               </h5>
            </div>
            <div id="toyyibpay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                            <div class="payment-notice alert alert-warning">
                            <p>{{__('if your currency is not available in Toyyibpay, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                        </div>
                        <label for="paytm_gateway"><strong>{{__('Enable/Disable Toyyibpay')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="toyyibpay_gateway"
                                   @if(!empty(get_static_option('toyyibpay_gateway')))
                                    checked
                                   @endif id="toyyibpay_gateway">
                            <span class="slider onff"></span>-
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong>{{__('Enable Test Mode For Toyyibpay')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="toyyibpay_test_mode"
                                   @if(!empty(get_static_option('toyyibpay_test_mode'))) checked
                                    @endif >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong>{{__('Toyyibpay Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('toyyibpay_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paytm_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="{{$paytm_img['img_url']}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paytm_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="toyyibpay_preview_logo"
                                   name="toyyibpay_preview_logo"--}}
                                   value="{{get_static_option('toyyibpay_preview_logo')}}">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="{{__('Select Image')}}"
                                    data-modaltitle="{{__('Upload Image')}}"
                                    data-toggle="modal"--}}
                                    data-target="#media_upload_modal">
                                {{__($paytm_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key">{{__('Set User Secret Key')}}</label>
                        <input type="text" name="toyyibpay_set_user_secret_key" id="toyyibpay_set_user_secret_key" value="{{get_static_option('toyyibpay_set_user_secret_key')}}" class="form-control">
                    </div>
                   <div class="form-group">
                        <label for="paytm_merchant_key">{{__('Set Category Code')}}</label>
                        <input type="text" name="toyyibpay_set_category_code" id="toyyibpay_set_category_code" value="{{get_static_option('toyyibpay_set_category_code')}}" class="form-control">
                    </div>

                </div>
            </div>

        <div class="card">
            <div class="card-header" id="bill_plz_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#pagalipay_settings_content"
                            aria-expanded="false">
                        <span class="page-title"> {{__('Pagalipay Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="pagalipay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p>{{__('if your currency is not available in Pagalipay, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                    </div>
                    <label for="paytm_gateway"><strong>{{__('Enable/Disable Pagalipay')}}</strong></label>
                    <label class="switch">
                        <input type="checkbox" name="pagalipay_gateway"
                               @if(!empty(get_static_option('pagalipay_gateway')))
                                   checked
                               @endif id="pagalipay_gateway">
                        <span class="slider onff"></span>-
                    </label>
                </div>
                <div class="form-group">
                    <label for="paytm_test_mode"><strong>{{__('Enable Test Mode For Pagalipay')}}</strong></label>
                    <label class="switch">
                        <input type="checkbox" name="pagalipay_test_mode"
                               @if(!empty(get_static_option('pagalipay_test_mode'))) checked
                                @endif >
                        <span class="slider onff"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label for="site_logo"><strong>{{__('Pagalipay Logo')}}</strong></label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            @php
                                $paytm_img = get_attachment_image_by_id(get_static_option('pagalipay_preview_logo'),null,true);
                                $paytm_image_btn_label = __('Upload Image');
                            @endphp
                            @if (!empty($paytm_img))
                                <div class="attachment-preview">
                                    <div class="thumbnail">
                                        <div class="centered">
                                            <img class="avatar user-thumb"
                                                 src="{{$paytm_img['img_url']}}"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                                @php  $paytm_image_btn_label = __('Change Image'); @endphp
                            @endif
                        </div>
                        <input type="hidden" id="pagalipay_preview_logo"
                               name="pagalipay_preview_logo"--}}
                               value="{{get_static_option('pagalipay_preview_logo')}}">
                        <button type="button"
                                class="btn btn-info media_upload_form_btn"
                                data-btntitle="{{__('Select Image')}}"
                                data-modaltitle="{{__('Upload Image')}}"
                                data-toggle="modal"--}}
                                data-target="#media_upload_modal">
                            {{__($paytm_image_btn_label)}}
                        </button>
                    </div>
                    <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key">{{__('Set Page ID')}}</label>
                    <input type="text" name="pagalipay_set_page_id" id="pagalipay_set_page_id" value="{{get_static_option('pagalipay_set_page_id')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key">{{__('Set Entity ID')}}</label>
                    <input type="text" name="pagalipay_set_entity_id" id="pagalipay_set_entity_id" value="{{get_static_option('pagalipay_set_entity_id')}}" class="form-control">
                </div>

            </div>
        </div>



        <div class="card">
            <div class="card-header" id="bill_plz_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#authorizenet_settings_content"
                            aria-expanded="false">
                        <span class="page-title"> {{__('Authorizenet Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="authorizenet_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p>{{__('if your currency is not available in Authorizenet, it will convert you currency value to INR value based on your currency exchange rate.')}}</p>
                    </div>
                    <label for="paytm_gateway"><strong>{{__('Enable/Disable Authorizenet')}}</strong></label>
                    <label class="switch">
                        <input type="checkbox" name="authorizenet_gateway"
                               @if(!empty(get_static_option('authorizenet_gateway')))
                                   checked
                               @endif id="authorizenet_gateway">
                        <span class="slider onff"></span>-
                    </label>
                </div>
                <div class="form-group">
                    <label for="paytm_test_mode"><strong>{{__('Enable Test Mode For Authorizenet')}}</strong></label>
                    <label class="switch">
                        <input type="checkbox" name="authorizenet_test_mode"
                               @if(!empty(get_static_option('authorizenet_test_mode'))) checked
                                @endif >
                        <span class="slider onff"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label for="site_logo"><strong>{{__('Authorizenet Logo')}}</strong></label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            @php
                                $paytm_img = get_attachment_image_by_id(get_static_option('authorizenet_preview_logo'),null,true);
                                $paytm_image_btn_label = __('Upload Image');
                            @endphp
                            @if (!empty($paytm_img))
                                <div class="attachment-preview">
                                    <div class="thumbnail">
                                        <div class="centered">
                                            <img class="avatar user-thumb"
                                                 src="{{$paytm_img['img_url']}}"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                                @php  $paytm_image_btn_label = __('Change Image'); @endphp
                            @endif
                        </div>
                        <input type="hidden" id="authorizenet_preview_logo"
                               name="authorizenet_preview_logo"--}}
                               value="{{get_static_option('authorizenet_preview_logo')}}">
                        <button type="button"
                                class="btn btn-info media_upload_form_btn"
                                data-btntitle="{{__('Select Image')}}"
                                data-modaltitle="{{__('Upload Image')}}"
                                data-toggle="modal"--}}
                                data-target="#media_upload_modal">
                            {{__($paytm_image_btn_label)}}
                        </button>
                    </div>
                    <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key">{{__('Set Merchant Login ID')}}</label>
                    <input type="text" name="authorizenet_set_merchant_login_id" id="authorizenet_set_merchant_login_id" value="{{get_static_option('authorizenet_set_merchant_login_id')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key">{{__('Set Merchant Transaction ID')}}</label>
                    <input type="text" name="authorizenet_set_merchant_transaction_id" id="authorizenet_set_merchant_transaction_id" value="{{get_static_option('authorizenet_set_merchant_transaction_id')}}" class="form-control">
                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-header" id="manual_payment_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#manual_payment_settings_content"
                            aria-expanded="false">
                        <span class="page-title"> {{__('Manual Payment Settings')}}</span>
                    </button>
                </h5>
            </div>
            <div id="manual_payment_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <label for="manual_payment_gateway"><strong>{{__('Enable/Disable Manual Payment')}}</strong></label>
                        <label class="switch">
                            <input type="checkbox" name="manual_payment_gateway"
                                   @if(!empty(get_static_option('manual_payment_gateway')))
                                       checked
                                   @endif id="manual_payment_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong>{{__('Manual Payment Logo')}}</strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                @php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('manual_payment_preview_logo'),null,false);
                                    $paytm_image_btn_label = __('Upload Image');
                                @endphp
                                @if (!empty($paytm_img))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="{{$paytm_img['img_url']}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php  $paytm_image_btn_label = __('Change Image'); @endphp
                                @endif
                            </div>
                            <input type="hidden" id="manual_payment_preview_logo"
                                   name="manual_payment_preview_logo"
                                   value="{{get_static_option('manual_payment_preview_logo')}}">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="{{__('Select Image')}}"
                                    data-modaltitle="{{__('Upload Image')}}"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                {{__($paytm_image_btn_label)}}
                            </button>
                        </div>
                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                    </div>
                    <div class="form-group">
                        <label for="site_manual_payment_name">{{__('Manual Payment Name')}}</label>
                        <input type="text" name="site_manual_payment_name"
                               id="site_manual_payment_name"
                               value="{{get_static_option('site_manual_payment_name')}}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="site_manual_payment_description">{{__('Manual Payment Description')}}</label>
                        <input type="hidden" name="site_manual_payment_description" value="{{get_static_option('site_manual_payment_description')}}">
                        <div class="summernote" data-content='{{get_static_option('site_manual_payment_description')}}'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>