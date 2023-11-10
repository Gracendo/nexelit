@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="appointment-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-search-wrapper">
                        <div class="right-part">
                            <select name="category" class="form-control">
                                <option value="">{{__("select category")}}</option>
                                @foreach($category_list as $category)
                                    <option @if($category->id == $cat_id) selected @endif value="{{$category->id}}">{{$category->lang_front->title}}</option>
                                @endforeach
                            </select>
                            <select name="sorting" class="form-control">
                                <option @if($sort === 'latest') selected @endif value="latest">{{__("Latest")}}</option>
                                <option @if($sort === 'oldest') selected @endif value="oldest">{{__("Oldest")}}</option>
                                <option @if($sort === 'top_rated') selected @endif value="top_rated">{{__("Best Rated")}}</option>
                                <option @if($sort === 'low_price') selected @endif value="low_price">{{__("Low Price")}}</option>
                                <option @if($sort === 'high_price') selected @endif value="high_price">{{__("High Price")}}</option>
                            </select>
                        </div>
                        <div class="left-part">
                            <div class="search-wrapper">
                                <form method="get">
                                    <input type="hidden" name="cat" value="{{$cat_id}}">
                                    <input type="hidden" name="sort" value="{{$sort}}">
                                    <div class="form-group search-box">
                                        <input type="text" class="form-control" name="s" placeholder="{{__('Search')}}" value="{{$search_term}}">
                                        <button class="submit-btn"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                        @forelse($all_appointment as $data)
                        <div class="col-lg-4">
                            <x-frontend.appointment.grid :appointment="$data"/>
                        </div>
                        @empty
                        <div class="col-lg-12 text-center">
                           <div class="alert alert-warning">{{__('nothing found')}} <strong>{{$search_term}}</strong></div>
                        </div>
                        @endforelse
                <div class="col-lg-12 text-center">
                    <nav class="pagination-wrapper " aria-label="Page navigation ">
                        {{$all_appointment->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        (function($) {
            'use strict';
            $(document).on('change','select[name="sorting"]',function (e){
                e.preventDefault();
                $('input[name="sort"]').val($(this).val());
            })
            $(document).on('change','select[name="category"]',function (e){
                e.preventDefault();
                $('input[name="cat"]').val($(this).val());
            })
        })(jQuery);
    </script>
@endsection
