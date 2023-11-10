@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('instructor:')}} {{$instructor->name}}
@endsection
@section('page-title')
    {{__('instructor:')}} {{$instructor->name}}
@endsection
@section('content')
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="instructor-info-wrapper">
                        <div class="img-wrap">
                            {!! render_image_markup_by_attachment_id($instructor->image) !!}
                        </div>
                        <div class="content">
                            <h3 class="title">{{$instructor->name}}</h3>
                            <span class="designation">{{$instructor->designation}}</span>
                            <ul class="social-wrap">
                                @foreach($instructor->social_icons as $icon)
                                    <li><a href="{{$instructor->social_icon_url[$loop->index] ?? '#'}}"><i class="{{$icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="instructor-content-wrapper content-tab-wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#about_me_tab" role="tab"  aria-selected="true">{{__('About Me')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#courses_tab" role="tab" aria-selected="false">{{__('Courses')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  data-toggle="tab" href="#reviews-tab" role="tab"  aria-selected="false">{{__('Reviews')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="about_me_tab" role="tabpanel">
                                <div class="tab-inner-area">
                                    {!! $instructor->lang_front->description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="courses_tab" role="tabpanel" >
                                <div class="my-courses-wrap">
                                    <div class="row">
                                        @php $a=1; @endphp
                                    @forelse($courses as $data)
                                            <div class="col-lg-6">
                                                <x-frontend.course.grid :course="$data" :increment="$a"/>
                                            </div>
                                            @php if($a == 4){ $a=1;}else{$a++;} @endphp
                                    @empty
                                        <div class="col-lg-12 text-center">
                                            <div class="alert alert-warning">{{__('nothing found')}} </div>
                                        </div>
                                    @endforelse
                                    <div class="col-lg-12 text-center">
                                        <nav class="pagination-wrapper " aria-label="Page navigation ">
                                            {{$courses->links()}}
                                        </nav>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews-tab" role="tabpanel" >
                                <div class="instructor-review-wrapper feedback-comment-list-wrap">
                                    <ul class="feedback-list">
                                        @forelse($reviews as $data)
                                            <li class="single-feedback-item">
                                                <div class="content">
                                                    <h4 class="title">{{$data->user ? optional($data->user)->username : __("Anonymous")}}</h4>
                                                    <div class="rating-wrap single">
                                                        @for( $i =1; $i <= $data->ratings; $i++ )
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <div class="description">{{$data->message}}</div>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="alert alert-warning">{{__('No Reviews Found')}}</li>
                                        @endforelse
                                    </ul>
                                    {{$reviews->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
