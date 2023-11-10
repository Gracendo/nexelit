@extends('frontend.frontend-page-master')
@section('page-title')
    {{get_static_option('quote_page_' . $user_select_lang_slug . '_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('quote_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('quote_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('quote_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="order-service-page-content-area padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="quote-content-area">
                        <h3 class="quote-title">{{get_static_option('quote_page_'.$user_select_lang_slug.'_form_title')}}</h3>
                        @include('backend.partials.message')
                        @include('backend.partials.error')
                        @if(env('APP_ENV') == 'development' )
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                You can build this form using admin panel <strong>Drag & Drop Form Builder</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{route('frontend.quote.message')}}" method="post" enctype="multipart/form-data" class="contact-form quote-form">
                            @csrf
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! render_form_field_for_frontend(get_static_option('quote_page_form_fields')) !!}
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-wrapper text-center">
                                        <button class="btn-boxed style-01" type="submit">{{get_static_option('quote_page_'.$user_select_lang_slug.'_form_button_text')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>
@endsection
