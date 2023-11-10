<div class="appointment-single-item">
    <div class="thumb"
            {!! render_background_image_markup_by_attachment_id($appointment->image,'','grid') !!}
    >
        @if(!empty($appointment->category))
        <div class="cat">
            <a href="{{route('frontend.appointment.category',['id' => $appointment->category->id,'any' => Str::slug(optional(optional($appointment->category)->lang_front)->title ?? __("Uncategorized"))])}}">{{optional(optional($appointment->category)->lang_front)->title ?? __("Uncategorized")}}</a>
        </div>
        @endif
    </div>
    <div class="content">
        @if(!empty(optional($appointment->lang_front)->designation))
            <span class="designation">{{optional($appointment->lang_front)->designation ?? ''}}</span>
        @endif
        @if(count($appointment->reviews) > 0)
            <div class="rating-wrap">
                <div class="ratings">
                    <span class="hide-rating"></span>
                    <span class="show-rating" style="width: {{{get_appointment_ratings_avg_by_id($appointment->id) / 5 * 100}}}%"></span>
                </div>
                <p><span class="total-ratings">({{count($appointment->reviews)}})</span></p>
            </div>
        @endif
        <a href="{{route('frontend.appointment.single',[optional($appointment->lang_front)->slug ?? __('untitled'),$appointment->id])}}"><h4 class="title">{{optional($appointment->lang_front)->title ?? ''}}</h4></a>
        @if(!empty(optional($appointment->lang_front)->location))
            <span class="location"><i class="fas fa-map-marker-alt"></i>{{optional($appointment->lang_front)->location ?? ''}}</span>
        @endif

        <p>{{Str::words(strip_tags(optional($appointment->lang_front)->short_description ?? ''),10)}}</p>
        <div class="btn-wrapper">
            <a href="{{route('frontend.appointment.single',[optional($appointment->lang_front)->slug ?? __('untitled'),$appointment->id])}}" class="boxed-btn">{{get_static_option('appointment_page_'.$user_select_lang_slug.'_booking_button_text')}}</a>
        </div>
    </div>
</div>