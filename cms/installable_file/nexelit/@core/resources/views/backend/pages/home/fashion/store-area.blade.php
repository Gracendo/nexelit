@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('site-title')
    {{__('Store Area')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Store Area Settings')}}</h4>

                        <form action="{{route('admin.home19.store.area')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-slug="{{$lang->slug}}" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" data-slug="{{$lang->slug}}" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="home20_popular_news_section_{{$lang}}_section_title">{{__('Section Title')}}</label>
                                            <input type="text" name="home19_store_{{$lang->slug}}_section_title" value="{{get_static_option('home19_store_'.$lang->slug.'_section_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home19_button_{{$lang}}_text">{{__('All Product Button Text')}}</label>
                                            <input type="text" name="home19_store_button_{{$lang->slug}}_text" value="{{get_static_option('home19_store_button_'.$lang->slug.'_text')}}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="home19_button_{{$lang}}_url">{{__('All Product Button URL')}}</label>
                                            <input type="text" name="home19_store_button_{{$lang->slug}}_url" value="{{get_static_option('home19_store_button_'.$lang->slug.'_url')}}" class="form-control">
                                        </div>

{{--                                        @php--}}
{{--                                            $all_json_product_category = json_decode(get_static_option('home19_store_section_'.$lang->slug.'_categories')) ?? [];--}}
{{--                                            $selected_data = is_array($all_json_product_category) && count($all_json_product_category) > 0 ? $all_json_product_category : [];--}}
{{--                                        @endphp--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>{{__('Product Category')}}</label>--}}
{{--                                            <select name="home19_store_section_{{$lang->slug}}_categories[]" multiple class="form-control nice-select wide">--}}
{{--                                                <option value="">{{__('Select Product')}}</option>--}}
{{--                                                @foreach($all_products_category as $category)--}}
{{--                                                    <option value="{{$category->id}}" {{ in_array($category->id, $selected_data) ? 'selected' : '' }}>{{$category->title}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

                                        <div class="form-group">
                                            <label >{{__('Products Category')}}</label>
                                            <select class="form-control nice-select wide categories_select" name="home19_store_section_{{$lang->slug}}_categories[]" multiple>
                                                <option value="">{{__('Select Categories')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group mt-3">
                                <label for="home20_popular_news_section_items">{{__('Product Items')}}</label>
                                <input type="number" name="home19_store_section_category_items" value="{{get_static_option('home19_store_section_category_items')}}" class="form-control" >
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            let niceSelect = $('.nice-select');
            if(niceSelect.length > 0){
                niceSelect.niceSelect();
            }
            fetchCategories($('.nav-tabs .nav-item.active').data('slug'));
            $(document).on('click','.nav-tabs .nav-item',function (e){
                //categories_select
                let langSlug = $(this).data('slug');
                fetchCategories(langSlug)
            });

            function fetchCategories(lang){
                $.ajax({
                    url: "{{route('admin.product.category.by.lang')}}",
                    type: 'POST',
                    data : {
                        _token : "{{csrf_token()}}",
                        lang:lang,
                        staticName: "home19_store_section_"+lang+"_categories"
                    },
                    success: function (data){

                        console.log()
                        //append data
                        let tabContainer = $('.tab-content .tab-pane[data-slug="'+lang+'"]');
                        let markup = '';

                        //loop through categories
                        $.each(data.categories,function (index,value){
                            let selected = data.selected ? data.selected.includes(value.id.toString()) ? 'selected' : '' : '';
                            markup += '<option '+selected+' value="'+value.id+'">'+value.title+'</option>';
                        });
                        tabContainer.find('.categories_select').append(markup);
                        niceSelect.niceSelect('update');

                    }
                });
            }

        });
    </script>
@endsection
