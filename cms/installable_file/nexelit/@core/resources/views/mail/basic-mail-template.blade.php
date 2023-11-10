<!doctype html>
<html lang="en">
@php
    $default_lang = get_default_language();
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{get_static_option('site_'.$default_lang.'_title').' '. __('Mail')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Open Sans', sans-serif;
        }
        .single-price-plan-01 {
            text-align: center;
            -webkit-transition: 0.3s ease-in;
            -o-transition: 0.3s ease-in;
            transition: 0.3s ease-in;
            position: relative;
            z-index: 0;
            overflow: hidden;
            background-color: {{get_static_option('site_color')}};
            padding: 40px 0 60px;
            -webkit-box-shadow: 0px 0px 7px 0px rgba(48, 55, 63, 0.35);
            box-shadow: 0px 0px 7px 0px rgba(48, 55, 63, 0.35);
            color: #fff;
        }

        /* event message */
        .single-events-list-item img {
            max-width: 100%;
            width: 100%;
        }
        .single-events-list-item {
            background-color: #ececec;
            padding: 20px;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
        }
        .single-events-list-item .thumb {
            position: relative;
        }

        .single-events-list-item .thumb .time-wrap {
            position: absolute;
            left: 10px;
            bottom: 15px;
            background-color: {{get_static_option('site_color')}};
            width: 60px;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .single-events-list-item .thumb .time-wrap span {
            display: block;
            font-size: 20px;
            line-height: 25px;
            font-weight: 700;
            color: #fff;
        }
        .single-events-list-item .content-area {
            text-align: left;
        }

        .single-events-list-item .content-area .title {
            font-size: 24px;
            line-height: 30px;
            font-weight: 600;
            text-decoration: none;
            color: #333;
            margin-bottom: 20px;
        }

        .single-events-list-item .content-area a {
            text-decoration: none;
        }
        .single-events-list-item .content-area .location,.single-events-list-item .content-area p {
            color: #656565;
        }

        .single-events-list-item .content-area .location strong {
            color: #333;
        }
        .single-price-plan-01 .price-header {
            position: relative;
        }

        .single-price-plan-01 .price-header .name-box .name {
            font-weight: 700;
            font-size: 24px;
            -webkit-transition: 0.3s ease-in;
            -o-transition: 0.3s ease-in;
            transition: 0.3s ease-in;
            margin: 0;
        }

        .single-price-plan-01 .price-header .title {
            color: #fff;
            font-size: 24px;
            line-height: 36px;
            font-weight: 600;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .single-price-plan-01 .price-header .price-wrap {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .single-price-plan-01 .price-header .price-wrap .price {
            font-size: 72px;
            line-height: 60px;
            font-weight: 700;
            -webkit-transition: 0.3s ease-in;
            -o-transition: 0.3s ease-in;
            transition: 0.3s ease-in;
            text-align: center;
            position: relative;
            z-index: 0;
            margin-top: 20px;
        }

        .single-price-plan-01 .price-header .price-wrap .price .dollar {
            font-size: 33px;
            line-height: 33px;
            position: relative;
            top: -12px;
        }

        .single-price-plan-01 .price-header .price-wrap .month {
            font-size: 18px;
            line-height: 20px;
            -webkit-transition: 0.3s ease-in;
            -o-transition: 0.3s ease-in;
            transition: 0.3s ease-in;
        }

        .single-price-plan-01 .price-body ul {
            margin: 0;
            padding: 0;
            margin-top: 25px;
            margin-bottom: 25px;
        }

        .single-price-plan-01 .price-body ul li {
            list-style: none;
            display: block;
            margin: 15px 0;
            font-size: 16px;
            font-weight: 500;
            -webkit-transition: 0.3s ease-in;
            -o-transition: 0.3s ease-in;
            transition: 0.3s ease-in;
            opacity: .7;
        }

        .single-price-plan-01 .price-body ul li:first-child {
            margin-top: 0;
        }

        .single-price-plan-01 .price-body ul li:last-child {
            margin-bottom: 0;
        }
        .billing-details {
            text-align: left;
            padding-left: 15px;
            margin-bottom: 50px;
        }

        .billing-details li {
            line-height: 30px;
        }

        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
            background-color: #f2f2f2;
            padding: 40px 0;
        }
        .inner-wrap {
            background-color: #fff;
            margin: 40px;
            padding: 30px 20px;
            text-align: left;
            box-shadow: 0 0 20px 0 rgba(0,0,0,0.01);
        }
        .inner-wrap p {
            font-size: 16px;
            line-height: 26px;
            color: #656565;
            margin: 0;
        }
        .message-wrap {
            background-color: #f2f2f2;
            padding: 30px;
            margin-top: 40px;
        }

        .message-wrap p {
            font-size: 14px;
            line-height: 26px;
        }
        .btn-wrap {
            text-align: center;
        }

        .btn-wrap .anchor-btn {
            background-color: {{get_static_option('site_color')}};
            color: #fff;
            font-size: 14px;
            line-height: 26px;
            font-weight: 500;
            text-transform: capitalize;
            text-decoration: none;
            padding: 8px 20px;
            display: inline-block;
            margin-top: 40px;
            border-radius: 5px;
            transition: all 300ms;
        }

        .btn-wrap .anchor-btn:hover {
            opacity: .8;
        }
        .verify-code{
            background-color:#f2f2f2;
            color:#333;
            padding: 10px 15px;
            border-radius: 3px;
            display: inline-block;
            margin: 20px;
        }
        table {
            margin: 0 auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #111d5c;
            color: white;
        }
         .logo-wrapper img{
            max-width: 200px;
        }

        .product-info-wrap {
            text-align: left;
            padding: 20px;
            padding-top: 0;
        }

        .product-info-wrap h4 {
            font-size: 18px;
            line-height: 20px;
            margin-bottom: 20px;
        }

        .product-info-wrap .pdetails {
            font-size: 14px;
            display: block;
            line-height: 20px;
            margin-bottom: 2px;
        }
        .product-info-wrap h4 a {
            color: #333;
        }
        .product-thumbnail img {
            max-width: 150px;
        }
        .product-title {
            text-align: left;
            font-weight: 500;
        }
        .billing-wrap,
        .shipping-wrap{
            text-align: left;
        }
        .subtitle {
            font-size: 20px;
            line-height: 30px;
            font-weight: 600;
        }
        .billing-wrap ul,
        .shipping-wrap ul{
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .billing-wrap ul li,
        .shipping-wrap ul li{
            margin: 5px 0;
        }
        .billing-wrap ul li strong,
        .shipping-wrap ul li strong{
            min-width: 100px;
            display: inline-block;
            position: relative;
        }

        .billing-wrap ul li strong:after ,
        .shipping-wrap ul li strong:after {
            position: absolute;
            right: 0;
            top: 0;
            content: ":";
        }
        .order-summery{
            margin-top: 40px;
            background-color: #f6f8ff;
            padding: 30px;
            text-align: left;
        }
        .order-summery table{
            text-align: left;
        }
        .extra-data {
            text-align: left;
            margin-bottom: 40px;
        }

        .extra-data ul {
            padding: 0;
            list-style: none;
            margin: 20px 0;
        }

        .extra-data ul li {
            margin-top: 14px;
        }
        .main-content-wrap .price-wrap {
            font-size: 60px;
            line-height: 70px;
            font-weight: 600;
            margin: 40px 0;
        }
    </style>
</head>
<body>

<div class="mail-container">
    <div class="logo-wrapper">
        <a href="{{url('/')}}">
            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
        </a>
    </div>
    <div class="inner-wrap">
        {!! $data['message'] !!}
    </div>
    <footer>
        {!! get_footer_copyright_text() !!}
    </footer>
</div>

</body>
</html>
