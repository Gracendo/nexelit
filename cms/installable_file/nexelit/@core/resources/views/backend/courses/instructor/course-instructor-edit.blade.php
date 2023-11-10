@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Instructor')}}
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
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between margin-bottom-30">
                            <h4 class="header-title">{{__('Edit Instructor')}}</h4>
                            <a href="{{route('admin.courses.instructor.all')}}" class="btn btn-info">{{__('All Instructor')}}</a>
                        </div>
                        <form action="{{route('admin.courses.instructor.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$instructor->id}}">
                            @php $default_lang = get_default_language();  @endphp
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($lang->slug == $default_lang) active @endif"  data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-40" >
                                @foreach($all_languages as $lang)
                                    @php $inst_item =  optional(optional($instructor->lang_query)->where('lang',$lang->slug))->first(); @endphp
                                    <div class="tab-pane fade @if($lang->slug == $default_lang) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="description">{{__('Description')}}</label>
                                            <textarea class="form-control" name="description[{{$lang->slug}}]"cols="30" rows="5"  placeholder="{{__('Description')}}">{{$inst_item->description ?? ''}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$instructor->name}}">
                            </div>
                            <div class="form-group">
                                <label for="designation">{{__('Designation')}}</label>
                                <input type="text" class="form-control" name="designation" value="{{$instructor->designation}}">
                            </div>
                            <x-media-upload :name="'image'" :title="__('Image')" :id="$instructor->image" :dimentions="'200x200px'" />

                            <div class="iconbox-repeater-wrapper dynamic-repeater">
                                <label for="additional_info" class="d-block">{{__('Social Icons')}}</label>
                                @forelse($instructor->social_icons as $social)
                                <div class="all-field-wrap">
                                    <x-backend.icon-field :title="__('Icon')" :name="'social_icon[]'" :icon="$social"/>
                                    <div class="form-group margin-top-20">
                                        <label for="">{{__('URL')}}</label>
                                        <input type="text" class="form-control" name="social_icon_url[]"  value="{{$instructor->social_icon_url[$loop->index] ?? ''}}">
                                    </div>
                                    <div class="action-wrap">
                                        <span class="add"><i class="ti-plus"></i></span>
                                        <span class="remove"><i class="ti-trash"></i></span>
                                    </div>
                                </div>
                                @empty
                                    <div class="all-field-wrap">
                                        <x-backend.icon-field :title="__('Icon')" :name="'social_icon[]'" :icon="null"/>
                                        <div class="form-group margin-top-20">
                                            <label for="">{{__('URL')}}</label>
                                            <input type="text" class="form-control" name="social_icon_url[]"  placeholder="{{__('social icon url')}}">
                                        </div>
                                        <div class="action-wrap">
                                            <span class="add"><i class="ti-plus"></i></span>
                                            <span class="remove"><i class="ti-trash"></i></span>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Save Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    @include('backend.partials.repeater.script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    @include('backend.partials.icon-field.js')
@endsection
