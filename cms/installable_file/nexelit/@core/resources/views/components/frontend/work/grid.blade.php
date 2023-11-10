<div class="single-case-studies-item">
    <div class="thumb">
        {!! render_image_markup_by_attachment_id($work->image) !!}
    </div>
    <div class="cart-icon">
        <h4 class="title"><a href="{{route('frontend.work.single',$work->slug)}}"> {{$work->title}}</a></h4>
    </div>
</div>