@extends('backend.admin-master')
@section('site-title')
    {{__('Featured Courses Area')}}
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
                        <h4 class="header-title">{{__('Featured Courses Area Settings')}}</h4>

                        <form action="{{route('admin.home17.featured.courses')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="course_home_page_{{$lang}}_featured_course_area_title">{{__('Title')}}</label>
                                            <input type="text" name="course_home_page_{{$lang->slug}}_featured_course_area_title" value="{{get_static_option('course_home_page_'.$lang->slug.'_featured_course_area_title')}}" class="form-control" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                           <div class="form-group">
                               <label for="featured_courses_ids">{{__('Featured Courses')}}</label>
                               <select name="featured_courses_ids[]" multiple class="form-control nice-select wide">
                                   @php $featured_courses_ids = get_static_option('featured_courses_ids') ?? [] ;@endphp
                                   @php $featured_courses_ids =  unserialize($featured_courses_ids,['class' => false]) ;@endphp
                                   @foreach($all_courses as $course)
                                       <option value="{{$course->id}}" @if(in_array($course->id,$featured_courses_ids)) selected @endif>{{$course->lang->title}}</option>
                                   @endforeach
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
    @include('backend.partials.icon-field.js')
    @include('backend.partials.repeater.script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        (function (){
            "use strict";

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }

        })(jQuery);
    </script>
@endsection