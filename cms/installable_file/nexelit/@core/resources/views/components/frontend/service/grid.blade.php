<div class="single-what-we-cover-item-02 margin-bottom-30">
    <div class="single-what-img">
        {!! render_image_markup_by_attachment_id($service->image) !!}
    </div>
    @if($service->icon_type === 'icon' || $service->icon_type == '')
        <div class="icon-02 style-0{{$increment ?? '' }}">
            <i class="{{$service->icon}}"></i>
        </div>
    @else
        <div class="img-icon style-0{{$increment ?? ''}}">
            {!! render_image_markup_by_attachment_id($service->img_icon) !!}
        </div>
    @endif
    <div class="content">
        <a href="{{route('frontend.services.single',$service->slug)}}"><h4 class="title">{{$service->title}}</h4></a>
        <p>{{$service->excerpt}}</p>
    </div>
</div>