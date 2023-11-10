@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('donation_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('donation_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('donation_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('donation_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('donation_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="donation-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                        @foreach($all_donations as $data)
                        <div class="col-lg-4">
                            <div class="contribute-single-item">
                                <div class="thumb">
                                    {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                    <div class="thumb-content">
                                        <div class="progress-item">
                                            <div class="single-progressbar">
                                                <div class="donation-progress" data-percent="{{get_percentage($data->amount,$data->raised)}}"></div>
                                            </div>
                                        </div>
                                        <div class="goal">
                                            <h4 class="raised">{{get_static_option('donation_raised_'.$user_select_lang_slug.'_text')}} @if(!empty($data->raised)){{amount_with_currency_symbol($data->raised)}}@else {{amount_with_currency_symbol(0)}} @endif</h4>
                                            <h4 class="raised">{{get_static_option('donation_goal_'.$user_select_lang_slug.'_text')}} {{amount_with_currency_symbol($data->amount)}}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="{{route('frontend.donations.single',$data->slug)}}"><h4 class="title">{{$data->title}}</h4></a>
                                    <p>{{strip_tags(Str::words(strip_tags($data->donation_content),20))}}</p>
                                    <div class="btn-wrapper">
                                        <a href="{{route('frontend.donations.single',$data->slug)}}" class="boxed-btn">{{get_static_option('donation_button_'.$user_select_lang_slug.'_text')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    <div class="col-lg-12 text-center">
                        <nav class="pagination-wrapper " aria-label="Page navigation ">
                            {{$all_donations->links()}}
                        </nav>
                    </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('assets/frontend/js/jQuery.rProgressbar.min.js')}}"></script>
    <script>
        (function($) {
            'use strict';
            var allProgress =  $('.donation-progress');
            $.each(allProgress,function (index, value) {
                $(this).rProgressbar({
                    percentage: $(this).data('percent'),
                    fillBackgroundColor: "{{get_static_option('site_color')}}"
                });
            })
        })(jQuery);
    </script>
@endsection
