<div class="course-single-grid-item">
    <div class="thumb">
        <a href="{{route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])}}">
            {!! render_image_markup_by_attachment_id($course->image) !!}
        </a>
        <div class="price-wrap">
            {{amount_with_currency_symbol($course->price)}}
            <del>{{amount_with_currency_symbol($course->sale_price)}}</del>
        </div>
        <div class="cat">
            <a class="bg-{{$increment ?? ''}}" href="{{route('frontend.course.category',[Str::slug(optional(optional($course->category)->lang_front)->title,'-',optional(optional($course->category)->lang_front)->lang),optional($course->category)->id])}}">{{optional(optional($course->category)->lang_front)->title}}</a>
        </div>
    </div>
    <div class="content">
        @if(count($course->reviews) > 0)
            <div class="rating-wrap">
                <div class="ratings">
                    <span class="hide-rating"></span>
                    <span class="show-rating" style="width: {{{get_course_ratings_avg_by_id($course->id) / 5 * 100}}}%"></span>
                </div>
                <p><span class="total-ratings">({{count($course->reviews)}})</span></p>
            </div>
        @endif
        <h3 class="title"><a href="{{route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])}}">{{Str::words(optional($course->lang_front)->title,6,'..')}}</a></h3>
        @if(!empty(optional($course->instructor)->id))
        <div class="instructor-wrap"><span>{{__('By')}}</span> <a href="{{route('frontend.course.instructor',[Str::slug(optional($course->instructor)->name),optional($course->instructor)->id])}}">{{optional($course->instructor)->name}}</a></div>
        @endif
        <div class="description">
            {!! Str::words(strip_tags(optional($course->lang_front)->description),15) !!}
        </div>
        <div class="footer-part">
            <span><i class="fas fa-users"></i> {{$course->enrolled_student}} {{__('Enrolled')}}</span>
            <span><i class="fas fa-clock"></i> {{$course->duration}} {{$course->duration_type}}</span>
        </div>
    </div>
</div>