@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Advertisement Area')}}
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
                        <h4 class="header-title">{{__('Advertisement Area Settings')}}</h4>

                        <form action="{{route('admin.home20.advertisement')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <h3 class="pb-3">{{__('Top Advertise Section ')}}</h3>
                            <div class="form-group">
                                <label for="title">{{__('Advertisement Type')}}</label>
                                <select class="form-control" name="home_page_newspaper_advertisement_type" id="type">
                                    <option selected disabled>{{__('Select a Type')}}</option>
                                    <option value="image"{{get_static_option('home_page_newspaper_advertisement_type') == 'image' ? 'selected' : ''}}>{{__('Image')}}</option>
                                    <option value="google_adsense"{{get_static_option('home_page_newspaper_advertisement_type') == 'google_adsense' ? 'selected' : ''}}>{{__('Google Adsense')}}</option>
                                    <option value="scripts"{{get_static_option('home_page_newspaper_advertisement_type') == 'scripts' ? 'selected' : ''}}>{{__('Scripts')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">{{__('Advertisement Size')}}</label>
                                <select class="form-control" name="home_page_newspaper_advertisement_size" id="size">
                                    <option selected disabled>{{__('Select a Size')}}</option>
                                    <option value="350*250" {{get_static_option('home_page_newspaper_advertisement_size') == '350*250' ? 'selected' : ''}}>{{__('350 x 250')}}</option>
                                    <option value="320*50" {{get_static_option('home_page_newspaper_advertisement_size') == '320*50' ? 'selected' : ''}}>{{__('320 x 50')}}</option>
                                    <option value="160*600" {{get_static_option('home_page_newspaper_advertisement_size') == '160*600' ? 'selected' : ''}}>{{__('160 x 600')}}</option>
                                    <option value="300*600" {{get_static_option('home_page_newspaper_advertisement_size') == '300*600' ? 'selected' : ''}}>{{__('300 x 600')}}</option>
                                    <option value="336*280" {{get_static_option('home_page_newspaper_advertisement_size') == '336*280' ? 'selected' : ''}}>{{__('336 x 280')}}</option>
                                    <option value="728*90" {{get_static_option('home_page_newspaper_advertisement_size') == '728*90' ? 'selected' : ''}}>{{__('728 x 90')}}</option>
                                    <option value="730*180" {{get_static_option('home_page_newspaper_advertisement_size') == '730*180' ? 'selected' : ''}}>{{__('730 x 180')}}</option>
                                    <option value="730*210" {{get_static_option('home_page_newspaper_advertisement_size') == '730*210' ? 'selected' : ''}}>{{__('730 x 210')}}</option>
                                    <option value="300*1050" {{get_static_option('home_page_newspaper_advertisement_size') == '300*1050' ? 'selected' : ''}}>{{__('300 X 1050')}}</option>
                                    <option value="950*160" {{get_static_option('home_page_newspaper_advertisement_size') == '950*160' ? 'selected' : ''}}>{{__('950 X 160')}}</option>
                                    <option value="950*200" {{get_static_option('home_page_newspaper_advertisement_size') == '950*200' ? 'selected' : ''}}>{{__('950 X 200')}}</option>
                                    <option value="250*1110" {{get_static_option('home_page_newspaper_advertisement_size') == '250*1110' ? 'selected' : ''}}>{{__('250 X 1110')}}</option>
                                </select>
                            </div>


                            <h3 class="mt-5 pb-3">{{__('Bottom Advertise Section ')}}</h3>
                            <div class="form-group">
                                <label for="title">{{__('Advertisement Type')}}</label>
                                <select class="form-control" name="home_page_newspaper_advertisement_type_bottom" id="type">
                                    <option selected disabled>{{__('Select a Type')}}</option>
                                    <option value="image"{{get_static_option('home_page_newspaper_advertisement_type_bottom') == 'image' ? 'selected' : ''}}>{{__('Image')}}</option>
                                    <option value="google_adsense"{{get_static_option('home_page_newspaper_advertisement_type_bottom') == 'google_adsense' ? 'selected' : ''}}>{{__('Google Adsense')}}</option>
                                    <option value="scripts"{{get_static_option('home_page_newspaper_advertisement_type_bottom') == 'scripts' ? 'selected' : ''}}>{{__('Scripts')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">{{__('Advertisement Size')}}</label>
                                <select class="form-control" name="home_page_newspaper_advertisement_size_bottom" id="size">
                                    <option selected disabled>{{__('Select a Size')}}</option>
                                    <option value="350*250" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '350*250' ? 'selected' : ''}}>{{__('350 x 250')}}</option>
                                    <option value="320*50" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '320*50' ? 'selected' : ''}}>{{__('320 x 50')}}</option>
                                    <option value="160*600" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '160*600' ? 'selected' : ''}}>{{__('160 x 600')}}</option>
                                    <option value="300*600" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '300*600' ? 'selected' : ''}}>{{__('300 x 600')}}</option>
                                    <option value="336*280" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '336*280' ? 'selected' : ''}}>{{__('336 x 280')}}</option>
                                    <option value="728*90" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '728*90' ? 'selected' : ''}}>{{__('728 x 90')}}</option>
                                    <option value="730*180" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '730*180' ? 'selected' : ''}}>{{__('730 x 180')}}</option>
                                    <option value="730*210" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '730*210' ? 'selected' : ''}}>{{__('730 x 210')}}</option>
                                    <option value="300*1050" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '300*1050' ? 'selected' : ''}}>{{__('300 X 1050')}}</option>
                                    <option value="950*160" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '950*160' ? 'selected' : ''}}>{{__('950 X 160')}}</option>
                                    <option value="950*200" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '950*200' ? 'selected' : ''}}>{{__('950 X 200')}}</option>
                                    <option value="250*1110" {{get_static_option('home_page_newspaper_advertisement_size_bottom') == '250*1110' ? 'selected' : ''}}>{{__('250 X 1110')}}</option>
                                </select>
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
                       staticName: "home20_popular_news_section_"+lang+"_categories"
                   },
                    success: function (data){
                       //append data
                        let tabContainer = $('.tab-content .tab-pane[data-slug="'+lang+'"]');
                        let markup = '';
                        //loop through categories
                        $.each(data.categories,function (index,value){
                            let selected = data.selected.includes(value.id.toString()) ? 'selected' : '';
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
