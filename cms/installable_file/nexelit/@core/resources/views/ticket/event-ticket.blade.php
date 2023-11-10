<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;600;700&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Events Ticket')}}</title>
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
            max-width: 600px;
            margin: 0 auto;
            margin-top: 40px;
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
        .logo-wrapper {
            margin: 0 auto;
            max-width: 250px;
        }
        .cart-table-wrapper.cart-wrapper ul {padding-left: 20px;}

        .cart-table-wrapper.cart-wrapper ul li strong {
            width: 200px;
            display: inline-block;
        }

        .cart-table-wrapper.cart-wrapper ul li+li {
            margin-top: 15px;
            border-top: 1px solid #e2e2e2;
            padding-top: 15px;
        }

        .cart-table-wrapper.cart-wrapper ul {
            border: 1px solid #e2e2e2;
            padding: 20px;
            margin: 0;
            list-style: none;
        }
        .main_title {
            text-align: center;
        }
        .qr-code-wrapper {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div id="pdf_content_wrapper">
        <div class="logo-wrapper">
            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
        </div>

        <h2 class="main_title">{{__('Event Attendance Information')}}</h2>
        <div class="cart-table-wrapper cart-wrapper">
            <ul>
                <li><strong>{{__('Attendance Name')}} </strong> {{$payment_log->name}}</li>
                <li><strong>{{__('Event Name')}} </strong> {{optional($attendance_details->event)->title}}</li>
                <li><strong>{{__('Venue Name')}} </strong> {{optional($attendance_details->event)->venue}}</li>
                <li><strong>{{__('Venue Location')}} </strong> {{optional($attendance_details->event)->venue_location}}</li>
                <li><strong>{{__('Venue Phone')}} </strong> {{optional($attendance_details->event)->venue_phone}}</li>
            </ul>
            <div class="qr-code-wrapper">
                @if(file_exists($file_name))
                    <img src="{{asset($file_name)}}" alt="">
                @endif    
            </div>
        </div>
    </div>
</body>
</html>
