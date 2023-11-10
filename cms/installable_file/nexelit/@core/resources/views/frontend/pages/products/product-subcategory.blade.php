@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Sub Category:')}} {{$category_name}}
@endsection
@section('site-title')
    {{__('Sub Category:')}} {{$category_name}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('product_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                @foreach($all_products as $data)
                    <div class="col-lg-3 col-md-6">
                        <x-frontend.product.grid :product="$data" :margin="true"/>
                    </div>
                @endforeach
                <div class="col-lg-12 text-center">
                    <nav class="pagination-wrapper " aria-label="Page navigation ">
                        {{$all_products->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('frontend.partials.ajax-addtocart')
