@extends('backend.admin-master')
@section('site-title')
    {{__('Products Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Products Page Settings")}}</h4>
                        <form action="{{route('admin.products.page.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="product_category_{{$lang->slug}}_text">{{__('Category Title')}}</label>
                                            <input type="text" name="product_category_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('product_category_'.$lang->slug.'_text')}}" id="product_category_{{$lang->slug}}_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_price_filter_{{$lang->slug}}_text">{{__('Price Filter Title')}}</label>
                                            <input type="text" name="product_price_filter_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('product_price_filter_'.$lang->slug.'_text')}}" id="product_price_filter_{{$lang->slug}}_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_rating_filter_{{$lang->slug}}_text">{{__('Rating Filter Title')}}</label>
                                            <input type="text" name="product_rating_filter_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('product_rating_filter_'.$lang->slug.'_text')}}" id="product_rating_filter_{{$lang->slug}}_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_add_to_cart_button_{{$lang->slug}}_text">{{__('Add To Cart Button Text')}}</label>
                                            <input type="text" name="product_add_to_cart_button_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('product_add_to_cart_button_'.$lang->slug.'_text')}}" id="product_add_to_cart_button_{{$lang->slug}}_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_view_option_button_{{$lang->slug}}_text">{{__('View Options Button Text')}}</label>
                                            <input type="text" name="product_view_option_button_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('product_view_option_button_'.$lang->slug.'_text')}}" id="product_view_option_button_{{$lang->slug}}_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_download_now_button_{{$lang->slug}}_text">{{__('Download Now Button Text')}}</label>
                                            <input type="text" name="product_download_now_button_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('product_download_now_button_'.$lang->slug.'_text')}}" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="product_post_items">{{__('Products Items')}}</label>
                                <input type="text" name="product_post_items"  class="form-control" value="{{get_static_option('product_post_items')}}" id="product_post_items">
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
