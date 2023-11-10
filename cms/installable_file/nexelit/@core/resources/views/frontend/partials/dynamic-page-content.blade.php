<section class="dynamic-page-content-area padding-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dynamic-page-content-wrap">
                    @if($page_post->visibility === 'user' && !auth()->guard('web')->check())
                        <p><strong><a href="{{route('user.login')}}">{{__('login')}}</a></strong> {{__('to see page content')}}</p>
                    @else
                        {!! $page_post->content !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>