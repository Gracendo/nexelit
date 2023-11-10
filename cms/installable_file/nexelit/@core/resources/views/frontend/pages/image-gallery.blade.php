@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
               <div class="col-lg-12">
                   <div class="case-studies-masonry-wrapper">
                       <ul class="case-studies-menu style-01">
                           <li class="active" data-filter="*">{{__('All')}}</li>
                           @foreach($all_category as $data)
                               <li data-filter=".{{Str::slug($data->title)}}">{{$data->title}}</li>
                           @endforeach
                       </ul>
                       <div class="case-studies-masonry">
                           @foreach($all_gallery_images as $data)
                               <div class="col-lg-4 col-md-6 masonry-item {{Str::slug(get_image_category_name_by_id($data->cat_id))}}">
                                   <div class="single-gallery-image ">
                                       @php
                                           $gallery_img = get_attachment_image_by_id($data->image,'full',false);
                                           $img_url = !empty($gallery_img) ? $gallery_img['img_url'] : '';
                                       @endphp
                                       {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                       <div class="img-hover">
                                           <a href="{{$img_url}}" title="{{$data->title}}" class="image-popup">
                                               <i class="fas fa-search"></i>
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       </div>
                   </div>
                   <div class="blog-pagination">
                       {!! $all_gallery_images->links() !!}
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection
