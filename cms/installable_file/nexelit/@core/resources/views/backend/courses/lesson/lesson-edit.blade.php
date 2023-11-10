@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Lesson')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
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
                            <h4 class="header-title">{{__('Edit Lesson')}}</h4>
                            <a href="{{route('admin.courses.lesson.all')}}" class="btn btn-info">{{__('All Lesson')}}</a>
                        </div>
                        <form action="{{route('admin.courses.lesson.update')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{$lesson->id}}">
                            <input type="hidden" name="curriculum_id" value="{{$lesson->curriculum_id}}">
                            <input type="hidden" name="course_id" value="{{$lesson->course_id}}">
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
                                    @php $lessonLang =  $lesson->lang_query->where(['lang' => $lang->slug,'lession_id' => $lesson->id])->first();@endphp
                                    <div class="tab-pane fade @if($lang->slug == $default_lang) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="title">{{__('Title')}}</label>
                                            <input type="text" class="form-control" name="title[{{$lang->slug}}]" placeholder="{{__('Title')}}" value="{{$lessonLang->title ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input type="hidden" name="description[{{$lang->slug}}]" value="{{$lessonLang->description ?? ''}}">
                                            <div class="summernote" data-content='{{$lessonLang->description ?? ''}}'></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="video_embed_code">{{__('Video Embed Code')}}</label>
                                <textarea name="video_embed_code" class="form-control" cols="30" rows="10">{{$lesson->video_embed_code}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="duration">{{__('Duration')}}</label>
                                <input type="text" class="form-control" name="duration" value="{{$lesson->duration}}">
                            </div>
                            <div class="form-group">
                                <label for="duration_type">{{__('Duration Type')}}</label>
                                <select name="duration_type" class="form-control">
                                    <option @if($lesson->duration_type === 'min') selected @endif value="min">{{__('Minute')}}</option>
                                    <option @if($lesson->duration_type === 'hr') selected @endif value="hr">{{__('Hours')}}</option>
                                    <option @if($lesson->duration_type === 'days') selected @endif value="days">{{__('Days')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control">
                                    <option @if($lesson->status === 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                                    <option @if($lesson->status === 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="preview"><strong>{{__('Preview')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="preview" @if($lesson->preview === 'yes') checked @endif>
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="duration">{{__('File')}}</label>
                                <input type="file" class="form-control" name="file" >
                                <small class="info-text">{{__('jpg,jpeg,png,pdf,doc,docx,txt,zip file are allowed, maximum 20mb')}}</small>
                            </div>
                            <div class="old-file-wrapper">
                                @if(file_exists('assets/uploads/course-lesson/'.$lesson->file))
                                    <a href="{{asset('assets/uploads/course-lesson/'.$lesson->file)}}" download="">{{$lesson->file}}</a>
                                @endif
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
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        (function ($){
            "use strict";

            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

        })(jQuery)
    </script>
@endsection
