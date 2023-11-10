@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Search For:')}} {{$search_term}}
@endsection
@section('site-title')
    {{__('Search For:')}} {{$search_term}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('events_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('events_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('events_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                            @forelse($all_events as $data)
                                <x-frontend.event.grid :event="$data"/>
                            @empty
                            <div class="col-lg-12">
                                <div class="alert alert-warning d-block">{{__('No Events Found')}}</div>
                            </div>
                            @endforelse
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper text-center" aria-label="Page navigation ">
                            {{$all_events->links()}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('event',['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
