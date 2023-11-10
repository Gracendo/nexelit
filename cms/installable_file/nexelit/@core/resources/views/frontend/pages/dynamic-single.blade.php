@extends('frontend.frontend-page-master')
@section('page-meta-data')
<meta name="description" content="{{$page_post->meta_description}}">
<meta name="tags" content="{{$page_post->meta_tags}}">
@endsection
@section('site-title')
    {{$page_post->title}}
@endsection
@section('page-title')
    {{$page_post->title}}
@endsection
@section('content')
    @if($page_post->visibility === 'user' && !auth()->guard('web')->check())
       <section class="padding-top-100 padding-bottom-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-warning"><strong><a href="{{route('user.login')}}">{{__('login')}}</a></strong> {{__('to see page content')}}</div>
                    </div>
                </div>
            </div>
       </section>
    @else
        @if(!empty($page_post->page_builder_status))
            {!! \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page',$page_post->id) !!}
        @else
            @include('frontend.partials.dynamic-page-content')
        @endif
    @endif
  
@endsection
