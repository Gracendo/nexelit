@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Hot News Area')}}
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
                        <h4 class="header-title">{{__('Hot News Area Settings')}}</h4>

                        <form action="{{route('admin.home20.hot')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="home20_hot_news_section_{{$lang}}_section_title">{{__('Section Title')}}</label>
                                            <input type="text" name="home20_hot_news_section_{{$lang->slug}}_section_title" value="{{get_static_option('home20_hot_news_section_'.$lang->slug.'_section_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label >{{__('Categories')}}</label>
                                            <select class="form-control nice-select wide categories_select" name="home20_hot_news_section_{{$lang->slug}}_categories[]" multiple>
                                                <option value="">{{__('Select Categories')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home20_hot_news_section_items">{{__('News Items')}}</label>
                                <input type="number" name="home20_hot_news_section_items" value="{{get_static_option('home20_hot_news_section_items')}}" class="form-control" >
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
                   url: "{{route('admin.blog.category.by.lang')}}",
                   type: 'POST',
                   data : {
                       _token : "{{csrf_token()}}",
                       lang:lang,
                       staticName: "home20_hot_news_section_"+lang+"_categories"
                   },
                    success: function (data){
                       //append data
                        let tabContainer = $('.tab-content .tab-pane[data-slug="'+lang+'"]');
                        let markup = '';
                        //loop through categories
                        $.each(data.categories,function (index,value){
                            let selected =  data.selected != null && data.selected.includes(value.id.toString()) ? 'selected' : '';
                            markup += '<option '+selected+' value="'+value.id+'">'+value.name+'</option>';
                        });
                        tabContainer.find('.categories_select').append(markup);
                        niceSelect.niceSelect('update');
                    }
                });
            }

        });
    </script>
@endsection
