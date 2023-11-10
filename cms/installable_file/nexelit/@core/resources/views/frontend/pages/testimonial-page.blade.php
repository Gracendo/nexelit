@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('testimonial_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('testimonial_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('testimonial_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('testimonial_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('testimonial_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="testimonial-area bg-image padding-top-110 padding-bottom-40">
        <div class="container">
            <div class="row">
                @foreach($all_testimonials as $data)
                    <div class="col-lg-6">
                        <div class="single-testimonial-item-02 margin-bottom-60">
                        <div class="content">
                            <div class="content-wrapper">
                                <p class="description">{{$data->description}}</p>
                                <div class="icon">
                                    <i class="flaticon-right-quote-1"></i>
                                </div>
                            </div>
                            <div class="author-details">
                                <div class="thumb">
                                    {!! render_image_markup_by_attachment_id($data->image) !!}
                                </div>
                                <div class="author-meta">
                                    <h4 class="title">{{$data->name}}</h4>
                                    <span class="designation">{{$data->designation}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <nav class="pagination-wrapper" aria-label="Page navigation ">
                        {{$all_testimonials->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
