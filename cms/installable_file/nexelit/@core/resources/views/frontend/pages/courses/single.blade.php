@extends('frontend.frontend-page-master')
@php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($course->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 @endphp
@section('og-meta')
    <meta property="og:url"  content="{{route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])}}" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="{{optional($course->lang_front)->title ?? ''}}" />
    <meta property="og:image" content="{{$post_img}}" />
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$course->lang_front->meta_description ?? ''}}">
    <meta name="tags" content="{{$course->lang_front->meta_tag ?? ''}}">
@endsection
@section('site-title')
    {{$course->lang_front->title ?? __('untitled')}}
@endsection
@section('page-title')
    {{$course->lang_front->title ?? __('untitled')}}
@endsection
@section('content')
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content-area-wrapper">
                        <div class="thumb">
                            {!! render_image_markup_by_attachment_id($course->image) !!}
                        </div>
                        <div class="content-tab-wrapper">
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-link" data-toggle="tab" href="#nav-overview" role="tab" aria-selected="true">{{get_static_option('course_single_'.$user_select_lang_slug.'_overview_tab_title')}}</a>
                                    <a class="nav-link active" data-toggle="tab" href="#nav-curriculum" role="tab"  aria-selected="false">{{get_static_option('course_single_'.$user_select_lang_slug.'_curriculum_tab_title')}}</a>
                                    <a class="nav-link"  data-toggle="tab" href="#nav-instructor" role="tab"  aria-selected="false">{{get_static_option('course_single_'.$user_select_lang_slug.'_instructor_tab_title')}}</a>
                                    <a class="nav-link"  data-toggle="tab" href="#nav-reviews" role="tab"  aria-selected="false">{{get_static_option('course_single_'.$user_select_lang_slug.'_reviews_tab_title')}}</a>
                                </div>
                            </nav>
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="nav-overview" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        {!! $course->lang_front->description ?? '' !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-curriculum" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        <div class="curriculum-item-wrapper">
                                            @foreach($all_curriculumn_with_lesson as $curriculumn_id => $curriculum)
                                            <div class="single-curriculum-item">
                                                <div id="accordion_{{$curriculumn_id}}">
                                                    <div class="card">
                                                        <div class="card-header" >
                                                            <div data-toggle="collapse" data-target="#collapseOne_{{$curriculumn_id}}" aria-expanded="{{$loop->first ? 'true' : 'false'}}" aria-controls="collapseOne">
                                                                <h3 class="title">{{$curriculum['curriculum']['title'] ?? ''}}</h3>
                                                                @php
                                                                $curr_description = $curriculum['curriculum']['description'] ?? '';
                                                                @endphp
                                                                @if(!empty($curr_description) )
                                                                <p class="description">{!! $curr_description !!}</p>
                                                                @endif
                                                                 <span class="lesson-count">{{$curriculum['curriculum']['count'] ?? 0}} {{__('Lessons')}}</span>
                                                            </div>
                                                           
                                                        </div>
                                                        <div id="collapseOne_{{$curriculumn_id}}" class="collapse @if($loop->first) show  @endif"  data-parent="#accordion_{{$curriculumn_id}}">
                                                            <div class="card-body">
                                                               <ul class="lesson-list">
                                                                   @php
                                                                    $lessons = $curriculum['lessons'] ?? [];
                                                                   @endphp

                                                                   @foreach($lessons as $lesson_id => $lesson)
                                                                   <li>
                                                                       <a href="{{route('frontend.course.lesson',['course_id' => $course->id,'id' => $lesson_id])}}">
                                                                           <div class="lession-title"><i class="fas fa-file-alt"></i> {{$lesson['title'] ?? __('Untitled')}}</div>
                                                                           <div class="right">
                                                                               <span class="duration">{{$lesson['duration'] ?? ''}} {{$lesson['duration_type'] ?? ''}}</span>
                                                                               @if(isset($lesson['preview']) && $lesson['preview'] === 'yes')
                                                                               <i class="fas fa-eye"></i>
                                                                               @elseif(isset($lesson['preview']) && $lesson['preview'] === 'no')
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
                                </div>
                                <div class="tab-pane fade" id="nav-instructor" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        <div class="instructor-wrap">
                                            <div class="thumb">
                                                {!! render_image_markup_by_attachment_id($course->instructor->image ?? '') !!}
                                            </div>
                                            <div class="content-wrap">
                                                <span class="designation">{{$course->instructor->designation ?? ''}}</span>
                                                @if(!empty(optional($course->instructor)->id))
                                                    <a href="{{route('frontend.course.instructor',[Str::slug($course->instructor->name),optional($course->instructor)->id])}}">
                                                @endif
                                                <h3 class="title">{{optional($course->instructor)->name}}</h3>
                                                </a>
                                                <div class="description">{!! optional($course->instructor)->lang_front->description ?? '' !!}</div>
                                                <ul class="social-wrap">
                                                    @foreach($course->instructor->social_icons ?? [] as $icon)
                                                        <li><a href="{{$course->instructor->social_icon_url[$loop->index] ?? '#'}}"><i class="{{$icon}}"></i></a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        <div class="feedback-wrapper">
                                            @if(auth()->guard('web')->check())
                                                <div class="feedback-form-wrapper">
                                                    <h3 class="title">{{get_static_option('course_single_'.$user_select_lang_slug.'_leave_feedback_title')}}</h3>
                                                    <form action="{{route('frontend.course.review')}}" method="post" id="appointment_rating_form" class="appointment-booking-form">
                                                        @csrf
                                                        <div class="error-message"></div>
                                                        <input type="hidden" name="course_id" value="{{$course->id}}">
                                                        <div class="form-group">
                                                            <label for="rating-empty-clearable2">{{__('Ratings')}}</label>
                                                            <input type="number" name="ratings"
                                                                   id="rating-empty-clearable2"
                                                                   class="rating text-warning"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{__('Message')}}</label>
                                                            <textarea name="message" cols="30" class="form-control" rows="5"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn-boxed appointment" id="appointment_ratings">{{__('Submit')}}  <i class="fas fa-spinner fa-spin d-none"></i></button>
                                                    </form>
                                                </div>
                                            @else
                                                @include('frontend.partials.ajax-login-form')
                                            @endif
                                            @if(count($course->reviews) > 0)
                                                <div class="feedback-comment-list-wrap margin-top-40">
                                                    <h3 class="title">{{get_static_option('course_single_'.$user_select_lang_slug.'_client_feedback_title')}}</h3>
                                                    <ul class="feedback-list">
                                                        @foreach($course->reviews as $data)
                                                            <li class="single-feedback-item">
                                                                <div class="content">
                                                                    <h4 class="title">{{$data->user ? $data->user->username : __("Anonymous")}}</h4>
                                                                    <div class="rating-wrap single">
                                                                        @for( $i =1; $i <= $data->ratings; $i++ )
                                                                            <i class="fas fa-star"></i>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="description">{{$data->message}}</div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-sidebar">
                        <div class="course-details-list-wrap">
                            <ul>
                                <li><strong><i class="fas fa-money"></i> {{__("Price")}}</strong> <span class="right">
                                    <span class="price-wrap">
                                        @if(!empty($course->price) && $course->price == 0)
                                            {{__('Free')}}
                                            @else
                                            {{amount_with_currency_symbol($course->price)}} <del>{{amount_with_currency_symbol($course->sale_price)}}</del></span>
                                        @endif
                                    </span>
                                </li>
                                @if(!empty(optional($course->instructor)->id))
                                <li><strong><i class="fas fa-user-graduate"></i> {{get_static_option('course_single_'.$user_select_lang_slug.'_instructor_tab_title')}}</strong> <span class="right"> <a href="{{route('frontend.course.instructor',[Str::slug($course->instructor->name),optional($course->instructor)->id])}}">{{optional($course->instructor)->name}}</a></span></li>
                                @endif
                                <li><strong><i class="fas fa-clock-o"></i> {{__("Duration")}}</strong> <span class="right"> {{$course->duration}} {{$course->duration_type}}</span></li>
                                <li><strong><i class="fas fa-tags "></i> {{__("Category")}}</strong> <span class="right"><a
                                                href="{{route('frontend.course.category',[Str::slug(optional(optional($course->category)->lang_front)->title,'-',optional(optional($course->category)->lang_front)->lang),optional($course->category)->id])}}">{{optional(optional($course->category)->lang_front)->title}}</a></span></li>
                                <li><strong><i class="fas fa-folder-open"></i> {{get_static_option('course_single_'.$user_select_lang_slug.'_curriculum_tab_title')}}</strong> <span class="right">{{count(unserialize($course->curriculum_id,['class' => false]))}}</span></li>
                                <li><strong><i class="fas fa-file-alt"></i> {{__("Lectures")}}</strong> <span class="right">{{optional($course->lesson_count)->count()}}</span></li>
                                <li><strong><i class="fas fa-users"></i> {{__("Enrolled")}}</strong> <span class="right">{{$course->enrolled_student}}</span></li>
                            </ul>
                            @if($course->enroll_required)
                            <div class="btn-wrapper">
                                @php
                                    $URL = $is_purchased ? route('frontend.course.lesson.start',$course->id) : route('frontend.course.enroll',$course->id);
                                    $button_url = $course->external_url ?? $URL;
                                @endphp
                                <a href="{{$button_url}}" class="boxed-btn {{$is_purchased  ? 'purchased' : ''}} ">{{$is_purchased ? __('Start Learning') : get_static_option('course_single_'.$user_select_lang_slug.'_enroll_button_text')}} <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="//use.fontawesome.com/5ac93d4ca8.js"></script>
    <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap4-rating-input.js')}}"></script>
    @include('frontend.partials.ajax-login-form-js')
    <script>
        (function ($){
            "use strict";

            $(document).on('click', '#appointment_ratings', function (e) {
                e.preventDefault();
                var myForm = document.getElementById('appointment_rating_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "{{route('frontend.course.review')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#appointment_ratings').children('i').removeClass('d-none');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        $('#appointment_ratings').children('i').addClass('d-none');
                        errMsgContainer.html('');
                        errMsgContainer.append('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');

                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#appointment_ratings').children('i').addClass('d-none');
                    }
                });
            });

        })(jQuery);
    </script>
@endsection
