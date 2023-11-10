<div class="accordion-wrapper">
    <div id="accordion-payment">
        <div class="card">
            <div class="card-header" id="paypal_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#paypal_settings_content"
                            aria-expanded="true">
                        <span class="page-title"> <?php echo e(__('Paypal Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="paypal_settings_content" class="collapse show"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p><?php echo e(__('if your currency is not available in paypal, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="paypal_gateway"><strong><?php echo e(__('Enable Paypal')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paypal_gateway"
                                   <?php if(!empty(get_static_option('paypal_gateway'))): ?> checked
                                   <?php endif; ?> id="paypal_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paypal_test_mode"><strong><?php echo e(__('Enable Test Mode For Paypal')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paypal_test_mode"
                                   <?php if(!empty(get_static_option('paypal_test_mode'))): ?> checked <?php endif; ?> >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong><?php echo e(__('Paypal Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paypal_img = get_attachment_image_by_id(get_static_option('paypal_preview_logo'),null,true);
                                    $paypal_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paypal_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="<?php echo e($paypal_img['img_url']); ?>"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paypal_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="paypal_preview_logo"
                                   name="paypal_preview_logo"
                                   value="<?php echo e(get_static_option('paypal_preview_logo')); ?>">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                <?php echo e(__($paypal_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>



                    <div class="form-group">
                        <label for="paypal_sandbox_client_id"><?php echo e(__('Paypal Sandbox Client ID')); ?></label>
                        <input type="text" name="paypal_sandbox_client_id"
                               class="form-control"
                               value="<?php echo e(get_static_option('paypal_sandbox_client_id')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="paypal_sandbox_client_secret"><?php echo e(__('Paypal Sandbox Client Secret')); ?></label>
                        <input type="text" name="paypal_sandbox_client_secret"
                               class="form-control"
                               value="<?php echo e(get_static_option('paypal_sandbox_client_secret')); ?>">
                    </div>

                    <div class="form-group">
                        <label for="paypal_sandbox_app_id"><?php echo e(__('Paypal Sandbox App ID')); ?></label>
                        <input type="text" name="paypal_sandbox_app_id"
                               class="form-control"
                               value="<?php echo e(get_static_option('paypal_sandbox_app_id')); ?>">
                    </div>

                    <div class="form-group">
                        <label for="paypal_live_client_id"><?php echo e(__('Paypal Live Client ID')); ?></label>
                        <input type="text" name="paypal_live_client_id"
                               class="form-control"
                               value="<?php echo e(get_static_option('paypal_live_client_id')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="paypal_live_client_secret"><?php echo e(__('Paypal Live Client Secret')); ?></label>
                        <input type="text" name="paypal_live_client_secret"
                               class="form-control"
                               value="<?php echo e(get_static_option('paypal_live_client_secret')); ?>">
                    </div>


                    <div class="form-group">
                        <label for="paypal_live_app_id"><?php echo e(__('Paypal Live App ID')); ?></label>
                        <input type="text" name="paypal_live_app_id"
                               class="form-control"
                               value="<?php echo e(get_static_option('paypal_live_app_id')); ?>">
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
                        <span class="page-title"> <?php echo e(__('Paytm Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="paytm_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <div class="payment-notice alert alert-warning">

                            <p><?php echo e(__('if your currency is not available in paytm, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                        </div>
                        <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable Paytm')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paytm_gateway"
                                   <?php if(!empty(get_static_option('paytm_gateway'))): ?> checked
                                   <?php endif; ?> id="paytm_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For Paytm')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paytm_test_mode"
                                   <?php if(!empty(get_static_option('paytm_test_mode'))): ?> checked
                                    <?php endif; ?> >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong><?php echo e(__('Paytm Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('paytm_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paytm_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="<?php echo e($paytm_img['img_url']); ?>"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="paytm_preview_logo"
                                   name="paytm_preview_logo"
                                   value="<?php echo e(get_static_option('paytm_preview_logo')); ?>">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                <?php echo e(__($paytm_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('Paytm Merchant Key')); ?></label>
                        <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" value="<?php echo e(get_static_option('paytm_merchant_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_mid"><?php echo e(__('Paytm Merchant ID')); ?></label>
                        <input type="text" name="paytm_merchant_mid" id="paytm_merchant_mid"  value="<?php echo e(get_static_option('paytm_merchant_mid')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_website"><?php echo e(__('Paytm Merchant Website')); ?></label>
                        <input type="text" name="paytm_merchant_website" id="paytm_merchant_website"  value="<?php echo e(get_static_option('paytm_merchant_website')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_channel"><?php echo e(__('Paytm channel')); ?></label>
                        <input type="text" name="paytm_channel" value="<?php echo e(get_static_option('paytm_channel')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_industry_type"><?php echo e(__('Paytm Industry Type')); ?></label>
                        <input type="text" name="paytm_industry_type" value="<?php echo e(get_static_option('paytm_industry_type')); ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="stripe_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#stripe_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Stripe Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="stripe_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                    </div>
                    <div class="form-group">
                        <label for="stripe_gateway"><strong><?php echo e(__('Enable/Disable Stripe')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="stripe_gateway"  <?php if(!empty(get_static_option('stripe_gateway'))): ?> checked <?php endif; ?> id="stripe_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="stripe_gateway"><strong><?php echo e(__('Enable/Disable Stripe Test Mode')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="stripe_test_mode"  <?php if(!empty(get_static_option('stripe_test_mode'))): ?> checked <?php endif; ?> id="stripe_test_mode">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="stripe_logo"><strong><?php echo e(__('Stripe Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $stripe_img = get_attachment_image_by_id(get_static_option('stripe_preview_logo'),null,true);
                                    $stripe_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($stripe_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($stripe_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $stripe_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="stripe_preview_logo" name="stripe_preview_logo" value="<?php echo e(get_static_option('stripe_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($stripe_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="stripe_public_key"><?php echo e(__('Stripe Public Key')); ?></label>
                        <input type="text" name="stripe_public_key" id="stripe_public_key" value="<?php echo e(get_static_option('stripe_public_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stripe_secret_key"><?php echo e(__('Stripe Secret')); ?></label>
                        <input type="text" name="stripe_secret_key" id="stripe_secret_key"  value="<?php echo e(get_static_option('stripe_secret_key')); ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="razorpay_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#razorpay_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Razorpay Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="razorpay_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p><?php echo e(__("Available Currency For Razorpay is, ['INR']")); ?></p>
                        <p><?php echo e(__('if your currency is not available in Razorpay, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_gateway"><strong><?php echo e(__('Enable/Disable Razorpay')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="razorpay_gateway"  <?php if(!empty(get_static_option('razorpay_gateway'))): ?> checked <?php endif; ?> id="razorpay_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_gateway"><strong><?php echo e(__('Enable/Disable Razorpay Test Mode')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="razorpay_test_mode"  <?php if(!empty(get_static_option('razorpay_test_mode'))): ?> checked <?php endif; ?> id="razorpay_test_mode">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_logo"><strong><?php echo e(__('Razorpay Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $razorpay_img = get_attachment_image_by_id(get_static_option('razorpay_preview_logo'),null,true);
                                    $razorpay_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($razorpay_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($razorpay_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $razorpay_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="razorpay_preview_logo" name="razorpay_preview_logo" value="<?php echo e(get_static_option('razorpay_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($razorpay_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_api_key"><?php echo e(__('Razorpay Key')); ?></label>
                        <input type="text" name="razorpay_api_key" id="razorpay_api_key" value="<?php echo e(get_static_option('razorpay_api_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="razorpay_api_secret"><?php echo e(__('Razorpay Secret')); ?></label>
                        <input type="text" name="razorpay_api_secret" id="razorpay_api_secret"  value="<?php echo e(get_static_option('razorpay_api_secret')); ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="paystack_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#paystack_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('PayStack Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="paystack_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">

                        <p><?php echo e(__('if your currency is not available in Paystack, it will convert you currency value to NGN value based on your currency exchange rate.')); ?></p>
                    </div>
                    <p class="margin-bottom-30 margin-top-20 info-paragraph">
                        <?php echo e(__('Don\'t forget to put below url to "Settings > API Key & Webhook > Callback URL" in your paystack admin panel')); ?>

                        <input type="text" class="info-url" value="<?php echo e(route('frontend.paystack.ipn')); ?>">
                    </p>
                    <div class="form-group">
                        <label for="paystack_gateway"><strong><?php echo e(__('Enable/Disable PayStack')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paystack_gateway"  <?php if(!empty(get_static_option('paystack_gateway'))): ?> checked <?php endif; ?> id="paystack_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paystack_gateway"><strong><?php echo e(__('Enable/Disable PayStack Test Mode')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="paystack_test_mode"  <?php if(!empty(get_static_option('paystack_test_mode'))): ?> checked <?php endif; ?> id="paystack_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paystack_preview_logo"><strong><?php echo e(__('PayStack Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paystack_img = get_attachment_image_by_id(get_static_option('paystack_preview_logo'),null,true);
                                    $paystack_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paystack_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($paystack_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paystack_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="paystack_preview_logo" name="paystack_preview_logo" value="<?php echo e(get_static_option('paystack_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($paystack_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="paystack_public_key"><?php echo e(__('PayStack Public Key')); ?></label>
                        <input type="text" name="paystack_public_key" id="paystack_public_key" value="<?php echo e(get_static_option('paystack_public_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paystack_secret_key"><?php echo e(__('PayStack Secret Key')); ?></label>
                        <input type="text" name="paystack_secret_key" id="paystack_secret_key"  value="<?php echo e(get_static_option('paystack_secret_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paystack_merchant_email"><?php echo e(__('PayStack Merchant Email')); ?></label>
                        <input type="text" name="paystack_merchant_email" id="paystack_merchant_email"  value="<?php echo e(get_static_option('paystack_merchant_email')); ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="mollie_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mollie_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Mollie Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="mollie_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p><?php echo e(__("Available Currency For Mollie is, ['AED','AUD','BGN','BRL','CAD','CHF','CZK','DKK','EUR','GBP','HKD','HRK','HUF','ILS','ISK','JPY','MXN','MYR','NOK','NZD','PHP','PLN','RON','RUB','SEK','SGD','THB','TWD','USD','ZAR']")); ?></p>
                        <p><?php echo e(__('if your currency is not available in mollie, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="mollie_gateway"><strong><?php echo e(__('Enable/Disable Mollie')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="mollie_gateway"  <?php if(!empty(get_static_option('mollie_gateway'))): ?> checked <?php endif; ?> id="mollie_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="mollie_gateway"><strong><?php echo e(__('Enable/Disable Mollie Test Mode')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="mollie_test_mode"  <?php if(!empty(get_static_option('mollie_test_mode'))): ?> checked <?php endif; ?> id="mollie_test_mode">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="mollie_preview_logo"><strong><?php echo e(__('Mollie Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $mollie_img = get_attachment_image_by_id(get_static_option('mollie_preview_logo'),null,true);
                                    $mollie_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($mollie_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($mollie_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $mollie_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="mollie_preview_logo" name="mollie_preview_logo" value="<?php echo e(get_static_option('mollie_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="mollie_public_key"><?php echo e(__('Mollie Public Key')); ?></label>
                        <input type="text" name="mollie_public_key" id="mollie_public_key" value="<?php echo e(get_static_option('mollie_public_key')); ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="flluterwave_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#flutterwave_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Flutterwave Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="flutterwave_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p><?php echo e(__("Available Currency For Flutterwave is, ['BIF','CAD','CDF','CVE','EUR','GBP','GHS','GMD','GNF','KES','LRD','MWK','MZN','NGN','RWF','SLL','STD','TZS','UGX','USD','XAF','XOF','ZMK','ZMW','ZWD']")); ?></p>
                        <p><?php echo e(__('if your currency is not available in flutterwave, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="flutterwave_gateway"><strong><?php echo e(__('Enable/Disable Flutterwave')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="flutterwave_gateway"  <?php if(!empty(get_static_option('flutterwave_gateway'))): ?> checked <?php endif; ?> id="flutterwave_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="flutterwave_test_mode"><strong><?php echo e(__('Enable Test Mode Flutterwave')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="flutterwave_test_mode" <?php if(!empty(get_static_option('flutterwave_test_mode'))): ?> checked <?php endif; ?>>
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="flutterwave_preview_logo"><strong><?php echo e(__('Flutterwave Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $mollie_img = get_attachment_image_by_id(get_static_option('flutterwave_preview_logo'),null,true);
                                    $mollie_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($mollie_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($mollie_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $mollie_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="flutterwave_preview_logo" name="flutterwave_preview_logo" value="<?php echo e(get_static_option('flutterwave_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="flw_public_key"><?php echo e(__('Flutterwave Public Key')); ?></label>
                        <input type="text" name="flw_public_key" id="flw_public_key" value="<?php echo e(get_static_option('flw_public_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="flw_secret_key"><?php echo e(__('Flutterwave Secret Key')); ?></label>
                        <input type="text" name="flw_secret_key" id="flw_secret_key" value="<?php echo e(get_static_option('flw_secret_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="flw_secret_hash"><?php echo e(__('Flutterwave Secret Hash')); ?></label>
                        <input type="text" name="flw_secret_hash" id="flw_secret_hash" value="<?php echo e(get_static_option('flw_secret_hash')); ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="midtrans_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#midtrans_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('MIdtranse Settings')); ?></span>
                    </button>
                </h5>
            </div>

            <div id="midtrans_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="flutterwave_gateway"><strong><?php echo e(__('Enable/Disable Flutterwave')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="midtrans_gateway"  <?php if(!empty(get_static_option('midtrans_gateway'))): ?> checked <?php endif; ?> id="flutterwave_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="midtrans_test_mode"><strong><?php echo e(__('Enable Test Mode Midtranse')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="midtrans_test_mode" <?php if(!empty(get_static_option('midtrans_test_mode'))): ?> checked <?php endif; ?>>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong><?php echo e(__('Midtranse Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $midtrans_img = get_attachment_image_by_id(get_static_option('midtrans_preview_logo'),null,true);
                                    $midtrans_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($midtrans_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($midtrans_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $midtrans_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="midtrans_preview_logo" name="midtrans_preview_logo" value="<?php echo e(get_static_option('midtrans_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="midtrans_merchant_id"><?php echo e(__('Midtranse Merchant ID')); ?></label>
                        <input type="text" name="midtrans_merchant_id" id="midtrans_merchant_id" value="<?php echo e(get_static_option('midtrans_merchant_id')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_server_key"><?php echo e(__('Midtranse Server Key')); ?></label>
                        <input type="text" name="midtrans_server_key" id="midtrans_server_key" value="<?php echo e(get_static_option('midtrans_server_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_client_key"><?php echo e(__('Midtranse Client Key')); ?></label>
                        <input type="text" name="midtrans_client_key" id="midtrans_client_key" value="<?php echo e(get_static_option('midtrans_client_key')); ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="payfast_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#payfast_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Payfast Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="payfast_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="payfast_gateway"><strong><?php echo e(__('Enable/Disable Payfast')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="payfast_gateway"  <?php if(!empty(get_static_option('payfast_gateway'))): ?> checked <?php endif; ?> id="payfast_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="payfast_test_mode"><strong><?php echo e(__('Enable Test Mode Payfast')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="payfast_test_mode" <?php if(!empty(get_static_option('payfast_test_mode'))): ?> checked <?php endif; ?>>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong><?php echo e(__('Payfast Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $payfast_img = get_attachment_image_by_id(get_static_option('payfast_preview_logo'),null,true);
                                    $payfast_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($midtrans_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($payfast_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $payfast_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="payfast_preview_logo" name="payfast_preview_logo" value="<?php echo e(get_static_option('payfast_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="midtrans_merchant_id"><?php echo e(__('Payfast Merchant ID')); ?></label>
                        <input type="text" name="payfast_merchant_id" id="payfast_merchant_id" value="<?php echo e(get_static_option('payfast_merchant_id')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_server_key"><?php echo e(__('Payfast Merchant Key')); ?></label>
                        <input type="text" name="payfast_merchant_key" id="payfast_merchant_key" value="<?php echo e(get_static_option('payfast_merchant_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="midtrans_client_key"><?php echo e(__('Payfast Passphrase')); ?></label>
                        <input type="text" name="payfast_passphrase" id="payfast_passphrase" value="<?php echo e(get_static_option('payfast_passphrase')); ?>" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="midtrans_environment"><?php echo e(__('Payfast ITN URL')); ?></label>
                        <input type="text" name="payfast_itn_url" id="payfast_itn_url" value="<?php echo e(get_static_option('payfast_itn_url')); ?>" class="form-control">
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="cashfree_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#cashfree_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Cashfree Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="cashfree_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="cashfree_gateway"><strong><?php echo e(__('Enable/Disable Cashfree')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cashfree_gateway"  <?php if(!empty(get_static_option('cashfree_gateway'))): ?> checked <?php endif; ?> id="cashfree_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="cashfree_test_mode"><strong><?php echo e(__('Enable Test Mode Cashfree')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cashfree_test_mode" <?php if(!empty(get_static_option('cashfree_test_mode'))): ?> checked <?php endif; ?>>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong><?php echo e(__('Cashfree Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $cashfree_img = get_attachment_image_by_id(get_static_option('cashfree_preview_logo'),null,true);
                                    $cashfree_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($midtrans_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($cashfree_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $cashfree_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="cashfree_preview_logo" name="cashfree_preview_logo" value="<?php echo e(get_static_option('cashfree_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="cashfree_app_id"><?php echo e(__('Cashfree App ID')); ?></label>
                        <input type="text" name="cashfree_app_id" id="cashfree_app_id" value="<?php echo e(get_static_option('cashfree_app_id')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cashfree_secret_key"><?php echo e(__('Cashfree Secret Key')); ?></label>
                        <input type="text" name="cashfree_secret_key" id="cashfree_secret_key" value="<?php echo e(get_static_option('cashfree_secret_key')); ?>" class="form-control">
                    </div>


                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="instamojo_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#instamojo_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Instamojo Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="instamojo_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="instamojo_gateway"><strong><?php echo e(__('Enable/Disable Instamojo')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="instamojo_gateway"  <?php if(!empty(get_static_option('instamojo_gateway'))): ?> checked <?php endif; ?> id="instamojo_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="instamojo_test_mode"><strong><?php echo e(__('Enable Test Mode Instamojo')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="instamojo_test_mode" <?php if(!empty(get_static_option('instamojo_test_mode'))): ?> checked <?php endif; ?>>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="midtrans_preview_logo"><strong><?php echo e(__('Instamojo Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $instamojo_img = get_attachment_image_by_id(get_static_option('instamojo_preview_logo'),null,true);
                                    $instamojo_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($midtrans_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($instamojo_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $instamojo_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="instamojo_preview_logo" name="instamojo_preview_logo" value="<?php echo e(get_static_option('instamojo_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="instamojo_client_id"><?php echo e(__('Instamojo Client ID')); ?></label>
                        <input type="text" name="instamojo_client_id" id="instamojo_client_id" value="<?php echo e(get_static_option('instamojo_client_id')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="instamojo_client_secret"><?php echo e(__('Instamojo Client Secret')); ?></label>
                        <input type="text" name="instamojo_client_secret" id="instamojo_client_secret" value="<?php echo e(get_static_option('instamojo_client_secret')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="instamojo_username"><?php echo e(__('Instamojo Username')); ?></label>
                        <input type="text" name="instamojo_username" id="instamojo_username" value="<?php echo e(get_static_option('instamojo_username')); ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="instamojo_password"><?php echo e(__('Instamojo Password')); ?></label>
                        <input type="text" name="instamojo_password" id="instamojo_password" value="<?php echo e(get_static_option('instamojo_password')); ?>" class="form-control">
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="marcado_pago_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#marcado_pago_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Marcado Pago Settings')); ?></span>
                    </button>
                </h5>
            </div>



            <div id="marcado_pago_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">

                    <div class="form-group">
                        <label for="marcadopago_gateway"><strong><?php echo e(__('Enable/Disable Marcado Pago')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="marcadopago_gateway"  <?php if(!empty(get_static_option('marcadopago_gateway'))): ?> checked <?php endif; ?> id="marcadopago_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="marcadopago_test_mode"><strong><?php echo e(__('Enable Test Mode Marcado Pago')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="marcadopago_test_mode" <?php if(!empty(get_static_option('marcadopago_test_mode'))): ?> checked <?php endif; ?>>
                            <span class="slider onff"></span>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="marcadopago_preview_logo"><strong><?php echo e(__('Marcado Pago gateway Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $marcadopago_img = get_attachment_image_by_id(get_static_option('marcadopago_preview_logo'),null,true);
                                    $marcadopago_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($midtrans_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="marcadopago_preview_logo" name="marcadopago_preview_logo" value="<?php echo e(get_static_option('marcadopago_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="marcado_pago_client_id"><?php echo e(__('Marcado Pago Client ID')); ?></label>
                        <input type="text" name="marcado_pago_client_id" id="marcado_pago_client_id" value="<?php echo e(get_static_option('marcado_pago_client_id')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="marcado_pago_client_secret"><?php echo e(__('Marcedo Pago Client Secret')); ?></label>

                        <input type="text" name="marcado_pago_client_secret" id="marcado_pago_client_secret" value="<?php echo e(get_static_option('marcado_pago_client_secret')); ?>" class="form-control">
                    </div>

                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header" id="squareup_settings">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#squareup_settings_settings_content" aria-expanded="false" >
                        <span class="page-title"> <?php echo e(__('Squareup Settings')); ?></span>
                    </button>
                </h5>
            </div>


            <div id="squareup_settings_settings_content" class="collapse"  data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <label for="marcadopago_gateway"><strong><?php echo e(__('Enable/Disable Squareup')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="squareup_gateway"  <?php if(!empty(get_static_option('squareup_gateway'))): ?> checked <?php endif; ?> id="squareup_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="marcadopago_test_mode"><strong><?php echo e(__('Enable Test Mode Squareup')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="squareup_test_mode" <?php if(!empty(get_static_option('squareup_test_mode'))): ?> checked <?php endif; ?>>
                            <span class="slider onff"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="marcadopago_preview_logo"><strong><?php echo e(__('Squareup gateway Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $marcadopago_img = get_attachment_image_by_id(get_static_option('squareup_preview_logo'),null,true);
                                    $marcadopago_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($midtrans_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="squareup_preview_logo" name="squareup_preview_logo" value="<?php echo e(get_static_option('squareup_preview_logo')); ?>">
                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                <?php echo e(__($mollie_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="marcado_pago_client_id"><?php echo e(__('Squareup Access Token')); ?></label>
                        <input type="text" name="squareup_access_token" id="squareup_access_token" value="<?php echo e(get_static_option('squareup_access_token')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="marcado_pago_client_secret"><?php echo e(__('Squareup Location ID')); ?></label>
                        <input type="text" name="squareup_location_id" id="squareup_location_id" value="<?php echo e(get_static_option('squareup_location_id')); ?>" class="form-control">
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
                        <span class="page-title"> <?php echo e(__('Cinetpay Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="cinetpay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <div class="payment-notice alert alert-warning">
                            <p><?php echo e(__('if your currency is not available in cinetpay, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                        </div>
                        <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable Cinetpay')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cinetpay_gateway"
                                   <?php if(!empty(get_static_option('cinetpay_gateway'))): ?> checked
                                   <?php endif; ?> id="cinetpay_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For Cinetpay')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="cinetpay_test_mode"
                                   <?php if(!empty(get_static_option('cinetpay_test_mode'))): ?> checked
                                    <?php endif; ?> >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong><?php echo e(__('Cinetpay Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('cinetpay_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paytm_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="<?php echo e($paytm_img['img_url']); ?>"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="cinetpay_preview_logo"
                                   name="cinetpay_preview_logo"
                                   value="<?php echo e(get_static_option('cinetpay_preview_logo')); ?>">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                <?php echo e(__($paytm_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('Cinetpay Api Key')); ?></label>
                        <input type="text" name="cinetpay_api_key" id="cinetpay_api_key" value="<?php echo e(get_static_option('cinetpay_api_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_mid"><?php echo e(__('Cinetpay Site ID')); ?></label>
                        <input type="text" name="cinetpay_site_id" id="cinetpay_site_id"  value="<?php echo e(get_static_option('cinetpay_site_id')); ?>" class="form-control">
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
                      <span class="page-title"> <?php echo e(__('BillPlz Settings')); ?></span>
                   </button>
               </h5>
            </div>
            <div id="bill_plz_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                            <div class="payment-notice alert alert-warning">
                            <p><?php echo e(__('if your currency is not available in Billplz, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                        </div>
                        <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable BillPlz')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="billplz_gateway"
                                   <?php if(!empty(get_static_option('billplz_gateway'))): ?>
                                    checked
                                   <?php endif; ?> id="billplz_gateway">
                            <span class="slider onff"></span>-
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For BillPlz')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="billplz_test_mode"
                                   <?php if(!empty(get_static_option('billplz_test_mode'))): ?> checked
                                    <?php endif; ?> >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong><?php echo e(__('BillPlz Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('billplz_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paytm_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="<?php echo e($paytm_img['img_url']); ?>"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="billplz_preview_logo"
                                   name="billplz_preview_logo"--}}
                                   value="<?php echo e(get_static_option('billplz_preview_logo')); ?>">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                    data-toggle="modal"--}}
                                    data-target="#media_upload_modal">
                                <?php echo e(__($paytm_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('BillPlz Key')); ?></label>
                        <input type="text" name="billplz_key" id="billplz_key" value="<?php echo e(get_static_option('billplz_key')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('BillPlz Version')); ?></label>
                        <input type="text" name="billplz_version" id="billplz_version" value="<?php echo e(get_static_option('billplz_version')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('BillPlz X-Signature')); ?></label>
                        <input type="text" name="billplz_x_signature" id="billplz_x_signature" value="<?php echo e(get_static_option('billplz_x_signature')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('BillPlz Collection Name')); ?></label>
                        <input type="text" name="billplz_collection_name" id="billplz_x_signature" value="<?php echo e(get_static_option('billplz_collection_name')); ?>" class="form-control">
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
                      <span class="page-title"> <?php echo e(__('Zitopay Settings')); ?></span>
                   </button>
               </h5>
            </div>
            <div id="zitopay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                            <div class="payment-notice alert alert-warning">
                            <p><?php echo e(__('if your currency is not available in Zitopay, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                        </div>
                        <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable Zitopay')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="zitopay_gateway"
                                   <?php if(!empty(get_static_option('zitopay_gateway'))): ?>
                                    checked
                                   <?php endif; ?> id="zitopay_gateway">
                            <span class="slider onff"></span>-
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For Zitopay')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="zitopay_test_mode"
                                   <?php if(!empty(get_static_option('zitopay_test_mode'))): ?> checked
                                    <?php endif; ?> >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong><?php echo e(__('Zitopay Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('zitopay_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paytm_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="<?php echo e($paytm_img['img_url']); ?>"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="zitopay_preview_logo"
                                   name="zitopay_preview_logo"--}}
                                   value="<?php echo e(get_static_option('zitopay_preview_logo')); ?>">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                    data-toggle="modal"--}}
                                    data-target="#media_upload_modal">
                                <?php echo e(__($paytm_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('Zitopay User Name')); ?></label>
                        <input type="text" name="zitopay_username" id="zitopay_username" value="<?php echo e(get_static_option('zitopay_username')); ?>" class="form-control">
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
                      <span class="page-title"> <?php echo e(__('Toyyibpay Settings')); ?></span>
                   </button>
               </h5>
            </div>
            <div id="toyyibpay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                            <div class="payment-notice alert alert-warning">
                            <p><?php echo e(__('if your currency is not available in Toyyibpay, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                        </div>
                        <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable Toyyibpay')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="toyyibpay_gateway"
                                   <?php if(!empty(get_static_option('toyyibpay_gateway'))): ?>
                                    checked
                                   <?php endif; ?> id="toyyibpay_gateway">
                            <span class="slider onff"></span>-
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For Toyyibpay')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="toyyibpay_test_mode"
                                   <?php if(!empty(get_static_option('toyyibpay_test_mode'))): ?> checked
                                    <?php endif; ?> >
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong><?php echo e(__('Toyyibpay Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('toyyibpay_preview_logo'),null,true);
                                    $paytm_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paytm_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="<?php echo e($paytm_img['img_url']); ?>"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="toyyibpay_preview_logo"
                                   name="toyyibpay_preview_logo"--}}
                                   value="<?php echo e(get_static_option('toyyibpay_preview_logo')); ?>">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                    data-toggle="modal"--}}
                                    data-target="#media_upload_modal">
                                <?php echo e(__($paytm_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('Set User Secret Key')); ?></label>
                        <input type="text" name="toyyibpay_set_user_secret_key" id="toyyibpay_set_user_secret_key" value="<?php echo e(get_static_option('toyyibpay_set_user_secret_key')); ?>" class="form-control">
                    </div>
                   <div class="form-group">
                        <label for="paytm_merchant_key"><?php echo e(__('Set Category Code')); ?></label>
                        <input type="text" name="toyyibpay_set_category_code" id="toyyibpay_set_category_code" value="<?php echo e(get_static_option('toyyibpay_set_category_code')); ?>" class="form-control">
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
                        <span class="page-title"> <?php echo e(__('Pagalipay Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="pagalipay_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p><?php echo e(__('if your currency is not available in Pagalipay, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                    </div>
                    <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable Pagalipay')); ?></strong></label>
                    <label class="switch">
                        <input type="checkbox" name="pagalipay_gateway"
                               <?php if(!empty(get_static_option('pagalipay_gateway'))): ?>
                                   checked
                               <?php endif; ?> id="pagalipay_gateway">
                        <span class="slider onff"></span>-
                    </label>
                </div>
                <div class="form-group">
                    <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For Pagalipay')); ?></strong></label>
                    <label class="switch">
                        <input type="checkbox" name="pagalipay_test_mode"
                               <?php if(!empty(get_static_option('pagalipay_test_mode'))): ?> checked
                                <?php endif; ?> >
                        <span class="slider onff"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label for="site_logo"><strong><?php echo e(__('Pagalipay Logo')); ?></strong></label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            <?php
                                $paytm_img = get_attachment_image_by_id(get_static_option('pagalipay_preview_logo'),null,true);
                                $paytm_image_btn_label = __('Upload Image');
                            ?>
                            <?php if(!empty($paytm_img)): ?>
                                <div class="attachment-preview">
                                    <div class="thumbnail">
                                        <div class="centered">
                                            <img class="avatar user-thumb"
                                                 src="<?php echo e($paytm_img['img_url']); ?>"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                                <?php  $paytm_image_btn_label = __('Change Image'); ?>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" id="pagalipay_preview_logo"
                               name="pagalipay_preview_logo"--}}
                               value="<?php echo e(get_static_option('pagalipay_preview_logo')); ?>">
                        <button type="button"
                                class="btn btn-info media_upload_form_btn"
                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                data-toggle="modal"--}}
                                data-target="#media_upload_modal">
                            <?php echo e(__($paytm_image_btn_label)); ?>

                        </button>
                    </div>
                    <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key"><?php echo e(__('Set Page ID')); ?></label>
                    <input type="text" name="pagalipay_set_page_id" id="pagalipay_set_page_id" value="<?php echo e(get_static_option('pagalipay_set_page_id')); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key"><?php echo e(__('Set Entity ID')); ?></label>
                    <input type="text" name="pagalipay_set_entity_id" id="pagalipay_set_entity_id" value="<?php echo e(get_static_option('pagalipay_set_entity_id')); ?>" class="form-control">
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
                        <span class="page-title"> <?php echo e(__('Authorizenet Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="authorizenet_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="payment-notice alert alert-warning">
                        <p><?php echo e(__('if your currency is not available in Authorizenet, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                    </div>
                    <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable Authorizenet')); ?></strong></label>
                    <label class="switch">
                        <input type="checkbox" name="authorizenet_gateway"
                               <?php if(!empty(get_static_option('authorizenet_gateway'))): ?>
                                   checked
                               <?php endif; ?> id="authorizenet_gateway">
                        <span class="slider onff"></span>-
                    </label>
                </div>
                <div class="form-group">
                    <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For Authorizenet')); ?></strong></label>
                    <label class="switch">
                        <input type="checkbox" name="authorizenet_test_mode"
                               <?php if(!empty(get_static_option('authorizenet_test_mode'))): ?> checked
                                <?php endif; ?> >
                        <span class="slider onff"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label for="site_logo"><strong><?php echo e(__('Authorizenet Logo')); ?></strong></label>
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            <?php
                                $paytm_img = get_attachment_image_by_id(get_static_option('authorizenet_preview_logo'),null,true);
                                $paytm_image_btn_label = __('Upload Image');
                            ?>
                            <?php if(!empty($paytm_img)): ?>
                                <div class="attachment-preview">
                                    <div class="thumbnail">
                                        <div class="centered">
                                            <img class="avatar user-thumb"
                                                 src="<?php echo e($paytm_img['img_url']); ?>"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                                <?php  $paytm_image_btn_label = __('Change Image'); ?>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" id="authorizenet_preview_logo"
                               name="authorizenet_preview_logo"--}}
                               value="<?php echo e(get_static_option('authorizenet_preview_logo')); ?>">
                        <button type="button"
                                class="btn btn-info media_upload_form_btn"
                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                data-toggle="modal"--}}
                                data-target="#media_upload_modal">
                            <?php echo e(__($paytm_image_btn_label)); ?>

                        </button>
                    </div>
                    <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key"><?php echo e(__('Set Merchant Login ID')); ?></label>
                    <input type="text" name="authorizenet_set_merchant_login_id" id="authorizenet_set_merchant_login_id" value="<?php echo e(get_static_option('authorizenet_set_merchant_login_id')); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="paytm_merchant_key"><?php echo e(__('Set Merchant Transaction ID')); ?></label>
                    <input type="text" name="authorizenet_set_merchant_transaction_id" id="authorizenet_set_merchant_transaction_id" value="<?php echo e(get_static_option('authorizenet_set_merchant_transaction_id')); ?>" class="form-control">
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
                        <span class="page-title"> <?php echo e(__('Manual Payment Settings')); ?></span>
                    </button>
                </h5>
            </div>
            <div id="manual_payment_settings_content" class="collapse"
                 data-parent="#accordion-payment">
                <div class="card-body">
                    <div class="form-group">
                        <label for="manual_payment_gateway"><strong><?php echo e(__('Enable/Disable Manual Payment')); ?></strong></label>
                        <label class="switch">
                            <input type="checkbox" name="manual_payment_gateway"
                                   <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                       checked
                                   <?php endif; ?> id="manual_payment_gateway">
                            <span class="slider onff"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="site_logo"><strong><?php echo e(__('Manual Payment Logo')); ?></strong></label>
                        <div class="media-upload-btn-wrapper">
                            <div class="img-wrap">
                                <?php
                                    $paytm_img = get_attachment_image_by_id(get_static_option('manual_payment_preview_logo'),null,false);
                                    $paytm_image_btn_label = __('Upload Image');
                                ?>
                                <?php if(!empty($paytm_img)): ?>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                     src="<?php echo e($paytm_img['img_url']); ?>"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" id="manual_payment_preview_logo"
                                   name="manual_payment_preview_logo"
                                   value="<?php echo e(get_static_option('manual_payment_preview_logo')); ?>">
                            <button type="button"
                                    class="btn btn-info media_upload_form_btn"
                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                    data-toggle="modal"
                                    data-target="#media_upload_modal">
                                <?php echo e(__($paytm_image_btn_label)); ?>

                            </button>
                        </div>
                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="site_manual_payment_name"><?php echo e(__('Manual Payment Name')); ?></label>
                        <input type="text" name="site_manual_payment_name"
                               id="site_manual_payment_name"
                               value="<?php echo e(get_static_option('site_manual_payment_name')); ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="site_manual_payment_description"><?php echo e(__('Manual Payment Description')); ?></label>
                        <input type="hidden" name="site_manual_payment_description" value="<?php echo e(get_static_option('site_manual_payment_description')); ?>">
                        <div class="summernote" data-content='<?php echo e(get_static_option('site_manual_payment_description')); ?>'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/payment-gateway/credentials.blade.php ENDPATH**/ ?>