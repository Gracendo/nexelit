@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Popular Cause Area')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Popular Cause Area Settings')}}</h4>

                        <form action="{{route('admin.home13.popular.cause')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($default_lang == $lang->slug) active @endif language_tab_btn" data-lang="{{$lang->slug}}" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($default_lang == $lang->slug) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="home_page_13_{{$lang}}_popular_cause_subtitle">{{__('Subtitle')}}</label>
                                            <input type="text" name="home_page_13_{{$lang->slug}}_popular_cause_subtitle" value="{{get_static_option('home_page_13_'.$lang->slug.'_popular_cause_subtitle')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_13_{{$lang}}_popular_cause_title">{{__('Title')}}</label>
                                            <input type="text" name="home_page_13_{{$lang->slug}}_popular_cause_title" value="{{get_static_option('home_page_13_'.$lang->slug.'_popular_cause_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_13_{{$lang}}_popular_cause_rise_text">{{__('Raised Text')}}</label>
                                            <input type="text" name="home_page_13_{{$lang->slug}}_popular_cause_rise_text" value="{{get_static_option('home_page_13_'.$lang->slug.'_popular_cause_rise_text')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_13_{{$lang}}_popular_cause_goal_text">{{__('Goal Text')}}</label>
                                            <input type="text" name="home_page_13_{{$lang->slug}}_popular_cause_goal_text" value="{{get_static_option('home_page_13_'.$lang->slug.'_popular_cause_goal_text')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_13_{{$lang->slug}}_popular_cause_popular_cause_list">{{__('Donation Cause')}}</label>
                                            <select name="home_page_13_{{$lang->slug}}_popular_cause_popular_cause_list[]" multiple class="form-control nice-select wide">
                                                <option value="">{{__('Select Donation Causes')}}</option>
                                                @php
                                                    $selected_donation = unserialize(get_static_option('home_page_13_'.$lang->slug.'_popular_cause_popular_cause_list'),['class' => false]);
                                                    $selected_cause = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
                                                @endphp
                                                @foreach($all_cause as $donation)
                                                    <option value="{{$donation->id}}" @if(in_array($donation->id,$selected_cause)) selected @endif>{{$donation->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="home_page_13_popular_cause_popular_cause_orderby">{{__('Orderby')}}</label>
                                <select name="home_page_13_popular_cause_popular_cause_orderby" class="form-control">
                                    @php $home_page_13_popular_cause_popular_cause_orderby = get_static_option('home_page_13_popular_cause_popular_cause_orderby');  @endphp
                                    <option @if($home_page_13_popular_cause_popular_cause_orderby == 'id') selected @endif value="id">{{__('Id')}}</option>
                                    <option @if($home_page_13_popular_cause_popular_cause_orderby == 'title') selected @endif value="title">{{__('Title')}}</option>
                                    <option @if($home_page_13_popular_cause_popular_cause_orderby == 'raised') selected @endif value="raised">{{__('Raised amount')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="home_page_13_popular_cause_popular_cause_order">{{__('Order')}}</label>
                                <select name="home_page_13_popular_cause_popular_cause_order" class="form-control">
                                    @php $home_page_13_popular_cause_popular_cause_items = get_static_option('home_page_13_popular_cause_popular_cause_items');  @endphp
                                    <option @if($home_page_13_popular_cause_popular_cause_items == 'asc') selected @endif value="asc">{{__('Ascending')}}</option>
                                    <option @if($home_page_13_popular_cause_popular_cause_items == 'desc') selected @endif value="desc">{{__('Descending')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="home_page_13_popular_cause_popular_cause_items">{{__('Total Items')}}</label>
                                <input type="number" name="home_page_13_popular_cause_popular_cause_items" class="form-control" min="1" value="{{get_static_option('home_page_13_popular_cause_popular_cause_items')}}">
                            </div>
                            <div class="form-group">
                                <label for="home_page_13_popular_cause_popular_cause_background_image">{{__('Background Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image_id = get_static_option('home_page_13_popular_cause_popular_cause_background_image');
                                            $event_img = get_attachment_image_by_id($image_id,null,false);
                                            $event_img_btn_label = __('Upload Image');
                                        @endphp
                                        @if (!empty($event_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$event_img['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $event_img_btn_label = __('Change Image'); @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" name="home_page_13_popular_cause_popular_cause_background_image" value="{{$image_id}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{$event_img_btn_label}}
                                    </button>
                                </div>
                                <small>{{__('Recommended image size 1920x1280')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        $(document).ready(function (){
            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }
            $(document).on('click','.language_tab_btn',function (){
                var lang = $(this).data('lang');
                //ajax call
                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.donation.cause.by.lang')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        lang: lang
                    },
                    success: function (data){
                        var container = $('#nav-home-'+lang).find('.nice-select');
                        container.html('');
                        var output = '<option value="">'+"{{__('Select Donation Causes')}}"+'</option>';
                        $.each(data.donations_items,function (index,value){
                            var selected = data.selected_items.includes(value.id.toString()) ? 'selected' : '';
                            // console.log(data.selected_items.includes(value.id.toString()))
                            output += '<option value="'+value.id+'" '+selected+'>'+value.title+'</option>'
                        });
                        container.html(output);
                        $('.nice-select').niceSelect('update');
                    }
                })

            });
        });
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
