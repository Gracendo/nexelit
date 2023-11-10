<html>
<head>
    {!! load_google_fonts() !!}
    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}
    <title> {{get_static_option('site_'.get_default_language().'_title')}}
        - {{get_static_option('site_'.get_default_language().'_tag_line')}}</title>
    <style>
        :root {
            --main-color-one: {{get_static_option('site_color')}};
            --main-color-two: {{get_static_option('site_main_color_two')}};
            --secondary-color: {{get_static_option('site_secondary_color')}};
            --heading-color: {{get_static_option('site_heading_color')}};
            --paragraph-color: {{get_static_option('site_paragraph_color')}};
            @php $heading_font_family = !empty(get_static_option('heading_font')) ? get_static_option('heading_font_family') :  get_static_option('body_font_family') @endphp
             --heading-font: "{{$heading_font_family}}", sans-serif;
            --body-font: "{{get_static_option('body_font_family')}}", sans-serif;
        }

        .StripeElement {
            background-color: white;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

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
            box-shadow: 0 0 35px 0 rgba(0, 0, 0, 0.1);
            padding: 40px;
            display: inline-block;
        }

        .srtipe-payment-inner-wrapper label {
            font-size: 16px;
            color: var(--paragraph-color);
            margin-bottom: 10px;
            line-height: 26px;
        }

        .srtipe-payment-inner-wrapper .submit-btn {
            display: inline-block;
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
        }

        .srtipe-payment-inner-wrapper .submit-btn:focus {
            outline: none;
            box-shadow: none;
        }

        .srtipe-payment-inner-wrapper .btn-wrapper {
            text-align: center;
        }

        .srtipe-payment-inner-wrapper .submit-btn[disabled] {
            background-color: #bdb3b3;
            cursor: not-allowed;
        }

        /*@media only screen and (max-width: 500px) {}*/
    </style>

    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div class="stripe-payment-wrapper">
    <div class="srtipe-payment-inner-wrapper">
        <h1>{{$stripe_data['title']}}</h1>
        <input type="hidden" name="order_id" id="order_id_input" value="{{$stripe_data['order_id']}}"/>
        <div class="btn-wrapper">
            <button class="submit-btn"  id="payment_submit_btn">{{__('Pay') }} {{amount_with_currency_symbol($stripe_data['price'])}}</button>
        </div>
    </div>
</div>

<script>
    // Create a Stripe client
    var stripe = Stripe("{{get_static_option('stripe_publishable_key')}}");
    var orderID = document.getElementById('order_id_input').value;
    var submitBtn = document.getElementById('payment_submit_btn');

    submitBtn.addEventListener('click', function () {
        // Create a new Checkout Session using the server-side endpoint you
        submitBtn.innerText = "{{__('Redirecting..')}}"
        submitBtn.disabled = true;
        // created in step 3.
        fetch("{{$stripe_data['route']}}", {
            headers: {
                "X-CSRF-TOKEN" : "{{csrf_token()}}",
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify({'order_id': orderID })
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({sessionId: session.id});
            })
            .then(function (result) {
                // If `redirectToCheckout` fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using `error.message`.
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
    });
</script>
</body>
</html>
