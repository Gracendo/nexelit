@extends('backend.admin-master')
@section('style')
    @include('backend.partials.media-upload.style')
@endsection
@section('site-title')
    {{__('Header Area')}}
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
                        <h4 class="header-title">{{__('Header Area Settings')}}</h4>

                        <form action="{{route('admin.home11.header')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($loop->first) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="political_home_page_header_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="political_home_page_header_{{$lang->slug}}_title" value="{{get_static_option('political_home_page_header_'.$lang->slug.'_title')}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="political_home_page_header_{{$lang->slug}}_description">{{__('Description')}}</label>
                                            <textarea name="political_home_page_header_{{$lang->slug}}_description" class="form-control" cols="30" rows="5">{{get_static_option('political_home_page_header_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="political_home_page_header_{{$lang}}_button_text">{{__('Button Text')}}</label>
                                            <input type="text" name="political_home_page_header_{{$lang->slug}}_button_text" value="{{get_static_option('political_home_page_header_'.$lang->slug.'_button_text')}}" class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="political_home_page_header_button_url">{{__('Button URL')}}</label>
                                <input type="text" name="political_home_page_header_button_url" value="{{get_static_option('political_home_page_header_button_url')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="political_home_page_header_left_image">{{__('Left Image')}}</label>
                                @php $signature_image_upload_btn_label = 'Upload Image'; @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image_id = get_static_option('political_home_page_header_left_image');
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
                                    <input type="hidden" name="political_home_page_header_left_image" value="{{$image_id}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{$image_id}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($signature_image_upload_btn_label)}}
                                    </button>
                                </div>
                                <small>{{__('recommended image size is 483 x 584 pixel')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="political_home_page_header_background_image">{{__('Background Image')}}</label>
                                @php $signature_image_upload_btn_label = 'Upload Image'; @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image_id = get_static_option('political_home_page_header_background_image');
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
                                    <input type="hidden" name="political_home_page_header_background_image" value="{{$image_id}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{$image_id}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($signature_image_upload_btn_label)}}
                                    </button>
                                </div>
                                <small>{{__('recommended image size is 350 x 253 pixel')}}</small>
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
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection