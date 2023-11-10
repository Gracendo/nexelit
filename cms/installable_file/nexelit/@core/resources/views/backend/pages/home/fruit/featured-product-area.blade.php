@extends('backend.admin-master')
@section('site-title')
    {{__('Featured Products Area')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Featured Products Area Settings')}}</h4>

                        <form action="{{route('admin.home15.featured.products')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php $default_lang = get_default_language() ; @endphp
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($default_lang == $key) active @endif language_tab_btn" data-lang="{{$lang->slug}}" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($default_lang == $key) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="home_page_15_{{$lang}}_featured_product_area_subtitle">{{__('Subtitle')}}</label>
                                            <input type="text" name="home_page_15_{{$lang->slug}}_featured_product_area_subtitle" value="{{get_static_option('home_page_15_'.$lang->slug.'_featured_product_area_subtitle')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_15_{{$lang}}_featured_product_area_title">{{__('Title')}}</label>
                                            <input type="text" name="home_page_15_{{$lang->slug}}_featured_product_area_title" value="{{get_static_option('home_page_15_'.$lang->slug.'_featured_product_area_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_15_{{$lang->slug}}_featured_product_area_items">{{__('Featured Products')}}</label>
                                            <select name="home_page_15_{{$lang->slug}}_featured_product_area_items[]" multiple class="form-control nice-select wide">
                                                <option value="">{{__('Select Product')}}</option>
                                                @php
                                                    $selected_donation = unserialize(get_static_option('home_page_15_'.$lang->slug.'_featured_product_area_items'),['class' => false]);
                                                    $selected_cause = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
                                                @endphp
                                                @foreach($all_products as $product)
                                                    <option value="{{$product->id}}" @if(in_array($product->id,$selected_cause)) selected @endif>{{$product->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
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
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }

            $(document).on('click','.language_tab_btn',function (){

                var lang = $(this).data('lang');
                var container = $('#nav-home-'+lang).find('.nice-select');
                if( container.has('option').length > 1 ) {
                    return;
                }
                //ajax call
                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.featured.product.by.lang')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        lang: lang
                    },
                    success: function (data){
                        var container = $('#nav-home-'+lang).find('.nice-select');
                        container.html('');
                        var output = '<option value="">'+"{{__('Select Product')}}"+'</option>';
                        $.each(data.product_items,function (index,value){
                            var selected = data.selected_items.includes(value.id.toString()) ? 'selected' : '';
                            output += '<option value="'+value.id+'" '+selected+'>'+value.title+'</option>'
                        });
                        container.html(output);
                        $('.nice-select').niceSelect('update');
                    }
                });

            });

        });
    </script>
@endsection