@extends('frontend.frontend-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/lesson-page.css')}}">
@endsection
@section('content')
<div class="navbar-outer">
    <div class="lesson-navbar-area">
        <div class="container-fluid">
            <div class="nav-inner-wrap">
                <div class="logo-wrapper">
                    <a href="{{url('/')}}" class="logo">
                        @if(!empty(filter_static_option_value('site_logo',$global_static_field_data)))
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)) !!}
                        @else
                            <h2 class="site-title">{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}</h2>
                        @endif
                    </a>
                </div>
                <div class="right-side-content">
                    <div class="course-title-wrap">
                        <h1 class="title">{{optional($course->lang_front)->title}}</h1>
                    </div>
                    <div class="button-wrap">
                        <a href="{{route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])}}" class="boxed-btn">{{__('Back To')}} {{get_static_option('courses_page_'.$user_select_lang_slug.'_name')}}</a>
                        <a href="#" class="boxed-btn" id="expand_lesson"><i class="fas fa-arrows-alt-h"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="course-content-wrapper-for-lesson">
    <div class="lesson-wrap">
        <div class="curriculum-item-wrapper">
            @foreach($course->curriculum as $curriculum)
                <div class="single-curriculum-item">
                    <div id="accordion_{{$curriculum->id}}">
                        <div class="card">
                            <div class="card-header" >
                                <div data-toggle="collapse" data-target="#collapseOne_{{$curriculum->id}}" aria-expanded="{{($preview_lesson->curriculum_id == $curriculum->id) ? 'true' : 'false'}}" aria-controls="collapseOne">
                                    <h3 class="title">{{optional($curriculum->lang_front)->title}}</h3>
                                    @if(optional($curriculum->lang_front)->description )
                                        <p class="description">{!! optional($curriculum->lang_front)->description !!}</p>
                                    @endif
                                </div>
                                <span class="lesson-count">{{optional($curriculum->lesson)->count()}} {{__('Lessons')}}</span>
                            </div>
                            <div id="collapseOne_{{$curriculum->id}}" class="collapse @if($preview_lesson->curriculum_id == $curriculum->id) show  @endif"  data-parent="#accordion_{{$curriculum->id}}">
                                <div class="card-body">
                                    <ul class="lesson-list">
                                        @foreach($curriculum->lesson as $lesson)
                                            <li class="@if($lesson->id == $preview_lesson->id) active @endif">
                                                <a href="{{route('frontend.course.lesson',['course_id' => $course->id,'id' => $lesson->id])}}">
                                                    <div class="lession-title"><i class="fas fa-file-alt"></i> {{optional($lesson->lang_front)->title ?? __('Untitled')}}</div>
                                                    <div class="right">
                                                        <span class="duration"> {{$lesson->duration}} {{$lesson->duration_type ?? ''}}</span>
                                                        @if(auth()->guard('web')->check() && $allowed_to_access_content)
                                                            <i class="fas fa-eye"></i>
                                                        @elseif(!empty($lesson->preview) && $lesson->preview === 'yes')
                                                            <i class="fas fa-eye"></i>
                                                        @elseif(!empty($lesson->preview) && $lesson->preview === 'no')
                                                            <i class="fas fa-lock"></i>
                                                        @endif
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="content-lesson-outer-wrap">
        <div class="content-lesson-wrap">
            @if($allowed_to_access_content || optional($preview_lesson)->preview === 'yes' )
                @if(optional($preview_lesson)->video_embed_code)
                <div class="video-embed-code-wrap">
                    {!! optional($preview_lesson)->video_embed_code !!}
                </div>
                @endif
                <div class="description">
                    {!! optional(optional($preview_lesson)->lang_front)->description ?? ''!!}
                    <div class="attachment-file margin-top-40">
                        @if(file_exists('assets/uploads/course-lesson/'.optional($preview_lesson)->file))
                            <a href="{{asset('assets/uploads/course-lesson/'.optional($preview_lesson)->file)}}" download="">{{optional($preview_lesson)->file}}</a>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-warning">{!! sprintf(__('This content is protected, please %s and enroll course to view this content!'),'<a href="'.route('user.login').'">'.__('Login').'</a>') !!}</div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        (function ($){
            "use strict";

            $(document).on('click','#expand_lesson',function (e){
                e.preventDefault();
                $(this).toggleClass('active')
                $('.course-content-wrapper-for-lesson .lesson-wrap').toggleClass('hide');
                $('.course-content-wrapper-for-lesson .content-lesson-wrap').toggleClass('expand');
            });

        })(jQuery);
    </script>
@endsection