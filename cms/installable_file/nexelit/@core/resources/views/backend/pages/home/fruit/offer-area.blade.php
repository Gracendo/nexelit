@extends('backend.admin-master')
@section('site-title')
    {{__('Offer Area')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-flash-msg/>
               <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Offer Settings')}}</h4>

                        <form action="{{route('admin.home15.offer')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                                $all_icon_fields =  get_static_option('home_page_15_offer_item_button_url');
                                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : ['#'];
                            @endphp
                            @foreach($all_icon_fields as $index => $icon_field)
                                <div class="iconbox-repeater-wrapper">
                                    <div class="all-field-wrap">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            @foreach($all_languages as $key => $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#tab_{{$lang->slug}}_{{$key + $index}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content margin-top-30" id="myTabContent">
                                            @foreach($all_languages as $key => $lang)
                                                @php
                                                    $offer_item_title = get_static_option('home_page_15_'.$lang->slug.'_offer_item_title');
                                                    $offer_item_title = !empty($offer_item_title) ? unserialize($offer_item_title,['class' => false]) : ['Fresh Lichi'];
                                                    $offer_item_short_description = get_static_option('home_page_15_'.$lang->slug.'_offer_item_short_description');
                                                    $offer_item_short_description = !empty($offer_item_short_description) ? unserialize($offer_item_short_description,['class' => false]) : [];
                                                    $offer_item_button_text = get_static_option('home_page_15_'.$lang->slug.'_offer_item_button_text');
                                                    $offer_item_button_text = !empty($offer_item_button_text) ? unserialize($offer_item_button_text,['class' => false]) : [];
                                                    $offer_item_image = get_static_option('home_page_15_offer_item_image');
                                                    $offer_item_image = !empty($offer_item_image) ? unserialize($offer_item_image,['class' => false]) : [];
                                                @endphp

                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$lang->slug}}_{{$key + $index}}" role="tabpanel" >
                                                    <div class="form-group">
                                                        <label for="home_page_15_{{$lang->slug}}_offer_item_title">{{__('Offer Title')}}</label>
                                                        <input type="text" name="home_page_15_{{$lang->slug}}_offer_item_title[]" class="form-control" value="{{$offer_item_title[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_15_{{$lang->slug}}_offer_item_short_description">{{__('Offer Short Description')}}</label>
                                                        <textarea class="form-control max-height-120" name="home_page_15_{{$lang->slug}}_offer_item_short_description[]" cols="30" rows="5">{{$offer_item_short_description[$index] ?? ''}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_15_{{$lang->slug}}_offer_item_button_text">{{__('Offer Button Text')}}</label>
                                                        <input type="text" name="home_page_15_{{$lang->slug}}_offer_item_button_text[]" class="form-control" value="{{$offer_item_button_text[$index] ?? ''}}">
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label for="home_page_15_offer_item_button_url" class="d-block">{{__('Offer Button URL')}}</label>
                                                <input type="text" class="form-control" value="{{$icon_field}}" name="home_page_15_offer_item_button_url[]">
                                            </div>
                                            <div class="form-group">
                                                <label for="home_page_15_offer_item_image">{{__('Image')}}</label>
                                                @php $signature_image_upload_btn_label = 'Upload Image'; @endphp
                                                <div class="media-upload-btn-wrapper">
                                                    <div class="img-wrap">
                                                        @php
                                                            $image_id = $offer_item_image[$index] ?? '';
                                                            $signature_img = get_attachment_image_by_id($image_id,null,false);
                                                        @endphp
                                                        @if (!empty($signature_img))
                                                            <div class="attachment-preview">
                                                                <div class="thumbnail">
                                                                    <div class="centered">
                                                                        <img class="avatar user-thumb" src="{{$signature_img['img_url']}}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $signature_image_upload_btn_label = 'Change Image'; @endphp
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="home_page_15_offer_item_image[]" value="{{$image_id}}">
                                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{$image_id}}" data-toggle="modal" data-target="#media_upload_modal">
                                                        {{__($signature_image_upload_btn_label)}}
                                                    </button>
                                                </div>
                                                <small>{{__('recommended image size is 250x200 pixel')}}</small>
                                            </div>
                                        </div>
                                        <div class="action-wrap">
                                            <span class="add"><i class="ti-plus"></i></span>
                                            <span class="remove"><i class="ti-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).on('click','.all-field-wrap .action-wrap .add',function (e){
            e.preventDefault();

            var el = $(this);
            var parent = el.parent().parent();
            var container = $('.all-field-wrap');
            var clonedData = parent.clone();
            var containerLength = container.length;
            clonedData.find('#myTab').attr('id','mytab_'+containerLength);
            clonedData.find('#myTabContent').attr('id','myTabContent_'+containerLength);
            var allTab =  clonedData.find('.tab-pane');
            allTab.each(function (index,value){
                var el = $(this);
                var oldId = el.attr('id');
                el.attr('id',oldId+containerLength);
            });
            var allTabNav =  clonedData.find('.nav-link');
            allTabNav.each(function (index,value){
                var el = $(this);
                var oldId = el.attr('href');
                el.attr('href',oldId+containerLength);
            });

            parent.parent().append(clonedData);

            if (containerLength > 0){
                parent.parent().find('.remove').show(300);
            }
            parent.parent().find('.iconpicker-popover').remove();
            parent.parent().find('.icp-dd').iconpicker();

        });

        $(document).on('click','.all-field-wrap .action-wrap .remove',function (e){
            e.preventDefault();
            var el = $(this);
            var parent = el.parent().parent();
            var container = $('.all-field-wrap');

            if (container.length > 1){
                el.show(300);
                parent.hide(300);
                parent.remove();
            }else{
                el.hide(300);
            }
        });
    </script>
@endsection