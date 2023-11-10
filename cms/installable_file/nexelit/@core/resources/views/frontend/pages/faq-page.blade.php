@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('faq_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('faq_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('faq_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('faq_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('faq_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <div class="faq-page-content-area padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion-wrapper">
                        @php $rand_number = rand(9999,99999999); @endphp
                        <div id="accordion_{{$rand_number}}">
                            @foreach($all_faqs as $key => $data)
                                @php
                                    $aria_expanded = 'false';
                                    if($data->is_open == 'on'){ $aria_expanded = 'true'; }
                                @endphp
                                <div class="card" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                    <div class="card-header" id="headingOne_{{$key}}" itemprop="name">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" data-target="#collapseOne_{{$key}}" role="button"
                                               aria-expanded="{{$aria_expanded}}" aria-controls="collapseOne_{{$key}}">
                                                {{$data->title}}
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne_{{$key}}" class="collapse @if($data->is_open == 'on') show @endif "
                                         aria-labelledby="headingOne_{{$key}}" data-parent="#accordion_{{$rand_number}}" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div class="card-body" itemprop="text">
                                            {!! $data->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
