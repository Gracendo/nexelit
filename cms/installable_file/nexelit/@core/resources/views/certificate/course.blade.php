<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Certificate Of Achievement')}}</title>
    <style>

        body * {
            font-family: 'Rubik', sans-serif;
        }
        #pdf_content_wrapper {
            max-width: 840px;
            margin: 0 auto;
            height: 595px;
        }
        .inner-content-wrap {
            padding: 50px 80px 0px 80px;
            text-align: center;
        }
        .inner-content-wrap .top-part .title {
            font-size: 60px;
            text-transform: uppercase;
            font-weight: 400;
            letter-spacing: 10px;
            line-height: 60px;
            margin-bottom: 15px;
            color: #333;
        }

        .inner-content-wrap .top-part .achievement {
            display: block;
            text-transform: uppercase;
            font-weight: 400;
            line-height: 20px;
            font-size: 16px;
            letter-spacing: 4px;
            color: #656565;
            margin-bottom: 10px;
        }
        /*.inner-content-wrap .top-part {*/
        /*    position: relative;*/
        /*}*/

        /*.inner-content-wrap .top-part:after {*/
        /*    position: absolute;*/
        /*    left: 50%;*/
        /*    bottom: -12px;*/
        /*    width: 150px;*/
        /*    height: 2px;*/
        /*    background-color: #d59545;*/
        /*    content: '';*/
        /*    transform: translateX(-50%);*/
        /*}*/

        .inner-content-wrap .name-part {
            margin-top: 0px;
        }

        .inner-content-wrap .name-part .name {
            font-size: 50px;
            text-transform: uppercase;
            font-weight: 400;
            color: #333;
            line-height: 60px;
            margin-bottom: 10px;
        }

        .inner-content-wrap .name-part .description {
            max-width: 550px;
            margin: 0 auto;
            font-size: 18px;
            line-height: 30px;
            color: #656565;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <div id="pdf_content_wrapper"
    @if(get_static_option('course_certificate_bg_image'))
        {!! render_background_image_markup_by_attachment_id(get_static_option('course_certificate_bg_image')) !!}
    @else
    @endif
    >
        <div class="inner-content-wrap">
            <div class="top-part">
                <h1 class="title">{{__('Certificate')}}</h1>
                <span class="achievement">{{__('Of Achievement')}}</span>
                <span class="achievement">{{__('This Certificate is proudly presented to')}}</span>
            </div>
            <div class="name-part">
                <h2 class="name">{{optional($course_certificate->user)->name}}</h2>
                <p class="description">
                    {{sprintf(__('For the complete %s success, Certificate Id: %s, Issues At %s'),
                    optional(optional($course_certificate->course)->lang)->title,
                    $course_certificate->id,
                    $course_certificate->created_at->format('D, d F Y h:i:sA')
                    )}}</p>
            </div>
        </div>
    </div>
</body>
</html>
