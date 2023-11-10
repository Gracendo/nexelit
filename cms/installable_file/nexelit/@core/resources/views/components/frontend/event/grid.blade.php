<div class="single-events-list-item">
    <div class="thumb">
        {!! render_image_markup_by_attachment_id($event->image,'','grid') !!}
    </div>
    <div class="content-area">
        <div class="top-part">
            <div class="time-wrap">
                <span class="date">{{date('d',strtotime($event->date))}}</span>
                <span class="month">{{date('M',strtotime($event->date))}}</span>
            </div>
            <div class="title-wrap">
                <a href="{{route('frontend.events.single',$event->slug)}}"><h4 class="title">{{$event->title}}</h4></a>
                <span class="location"><i class="fas fa-map-marker-alt"></i> {{$event->venue_location}}</span>
            </div>
        </div>
        <p>{{strip_tags(Str::words(strip_tags($event->content),20))}}</p>
    </div>
</div>