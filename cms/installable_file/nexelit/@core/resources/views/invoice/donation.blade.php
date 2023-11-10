<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;600;700&display=swap" rel="stylesheet">

    <title>{{__('Donations Invoice')}}</title>
    <style>

        body * {
            font-family: 'Baloo Tamma 2', cursive;
        }

        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

        /* cart page */
        .cart-wrapper table .thumbnail {
            max-width: 50px;
        }

        .cart-wrapper table .product-title {
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            transition: 300ms all;
        }

        .cart-wrapper table .quantity {
            max-width: 80px;
            border: 1px solid #e2e2e2;
            height: 40px;
            padding-left: 10px;
        }

        .cart-wrapper table {
            color: #656565;
        }

        .cart-wrapper table th {
            color: #333;
        }

        .cart-total-wrap .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .cart-total-table table td {
            color: #333;
        }

        .billing-details-wrapper .login-form {
            max-width: 450px;
        }

        .billing-details-wrapper {
            margin-bottom: 80px;
        }

        .billing-details-fields-wrapper .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .product-orders-summery-warp .title {
            font-size: 24px;
            text-align: left;
            margin-bottom: 7px;
        }

        #pdf_content_wrapper {
            max-width: 1000px;
        }

        .cart-wrapper table .thumbnail img {
            width: 80px;
        }

        .cart-total-table-wrap .title {
            font-size: 25px;
            line-height: 34px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .billing-and-shipping-details div:first-child {
            margin-bottom: 30px;
        }

        .billing-and-shipping-details div ul {
            margin: 0;
            padding: 0;
        }

        .billing-and-shipping-details div ul li {
            font-size: 16px;
            line-height: 30px;
        }

        .billing-and-shipping-details div .title {
            font-size: 22px;
            line-height: 26px;
            font-weight: 600;
        }

        .billing-and-shipping-details {
            margin-top: 40px;
        }

        .billing-wrap ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
    </style>
</head>
<body>
<div id="pdf_content_wrapper">
    <div class="logo-wrapper">
        {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
    </div>
    <h2 class="main_title">{{__('Donation Information')}}</h2>
    <div class="cart-table-wrapper cart-wrapper">
        @if(!empty($donation_details))
            <div class="table-responsive cart-table">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{__('Thumbnail')}}</th>
                        <th>{{__('Donation Info')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="thumbnail">
                                {!! render_image_markup_by_attachment_id($donation_details->donation->image,'','thumb') !!}
                            </div>
                        </td>
                        <td>
                            <div class="event-info-wrap">
                                <ul>
                                    <li><strong>{{__('Donation Log ID')}}:</strong> #{{$donation_details->id}}</li>
                                    <li><strong>{{__('Donation Case Title')}}:</strong> {{{$donation_details->donation->title}}}</li>
                                    <li><strong>{{__('Donated Amount')}}:</strong> {{amount_with_currency_symbol($donation_details->amount,true)}}</li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="cart-total-table-wrap">
        <h4 class="title">{{__('Donation Summery')}}</h4>
        <div class="cart-total-table table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>{{__('Donor Name')}}</th>
                    <td>{{$donation_details->name}}</td>
                </tr>
                <tr>
                    <th>{{__('Donor Email')}}</th>
                    <td>{{$donation_details->email}}</td>
                </tr>
                <tr>
                    <th>{{__('Amount')}}</th>
                    <td>{{amount_with_currency_symbol($donation_details->amount,true)}}</td>
                </tr>
                <tr>
                    <th>{{__('Payment Gateway')}}</th>
                    <td>{{str_replace('_',' ',$donation_details->payment_gateway)}}</td>
                </tr>
                <tr>
                    <th>{{__('Payment Status')}}</th>
                    <td>{{$donation_details->status}}</td>
                </tr>
                <tr>
                    <th>{{__('Transaction ID')}}</th>
                    <td>{{$donation_details->transaction_id}}</td>
                </tr>
                <tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
