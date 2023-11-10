<div class="single-knowledgebase-list-item {{$class ?? ''}}">
    <h4 class="title"><a href="{{route('frontend.knowledgebase.single',$donation->slug)}}"><i
                    class="fas fa-folder"></i> {{$donation->title}}</a></h4>
    <div class="short-content">
        {!! Str::words(strip_tags($donation->content),50) !!}
    </div>
</div>