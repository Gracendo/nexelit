@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('feedback_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('feedback_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('feedback_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('feedback_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('feedback_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title text-center margin-bottom-50">
                                    <h4 class="title">{{get_static_option('feedback_page_form_'.$user_select_lang_slug.'_form_title')}}</h4>
                                </div>
                                @include('backend.partials.message')
                                @include('backend.partials.error')
                            </div>
                        </div>
                        <form action="{{route('frontend.clients.feedback.store')}}" method="post" class="contact-page-form" enctype="multipart/form-data">
                            @csrf
                             <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <div class="form-group">
                                <label for="name">{{get_static_option('feedback_page_form_'.$user_select_lang_slug.'_name_label')}}</label>
                                <input type="text" name="name" id="name" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="email">{{get_static_option('feedback_page_form_'.$user_select_lang_slug.'_email_label')}}</label>
                                <input type="text" name="email" id="email" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="ratings">{{get_static_option('feedback_page_form_'.$user_select_lang_slug.'_ratings_label')}}</label>
                                <input type="hidden" name="ratings" id="ratings" class="form-control" >
                                <ul class="ratings_list">
                                    <li data-value="1">1</li>
                                    <li data-value="2">2</li>
                                    <li data-value="3">3</li>
                                    <li data-value="4">4</li>
                                    <li data-value="5">5</li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="description">{{get_static_option('feedback_page_form_'.$user_select_lang_slug.'_description_label')}}</label>
                                <textarea name="description" id="description" class="form-control" cols="30" rows="10" ></textarea>
                            </div>
                            {!! render_form_field_for_frontend(get_static_option('feedback_page_form_fields')) !!}
                            <div class="btn-wrapper">
                                <button type="submit" class="boxed-btn reverse-color">{{get_static_option('feedback_page_form_'.$user_select_lang_slug.'_button_text')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(!empty(get_static_option('site_google_captcha_v3_site_key')) && !empty(get_static_option('site_google_captcha_status')))
    <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>
    @endif
    <script>
        (function ($) {
            "use strict";

            $(document).on('click','.ratings_list li',function (e) {
                e.preventDefault();

                var el = $(this);
                var value = el.data('value');
                el.addClass('selected').siblings().removeClass('selected');
                $('#ratings').val(value);
            });

        })(jQuery);
    </script>
@endsection
