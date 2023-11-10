@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('video_gallery_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('video_gallery_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('video_gallery_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('video_gallery_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('video_gallery_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                @foreach($all_gallery_videos as $data)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-gallery-video">
                            <div class="embed-code">
                                {!! $data->embed_code !!}
                            </div>
                            <div class="content">
                                <h3 class="title">{{$data->title}}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
               <div class="col-lg-12">
                   <div class="blog-pagination">
                       {!! $all_gallery_videos->links() !!}
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection
