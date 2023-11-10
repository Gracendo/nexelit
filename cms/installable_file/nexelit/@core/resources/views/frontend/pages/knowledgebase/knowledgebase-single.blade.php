@extends('frontend.frontend-page-master')
@section('site-title')
    {{$knowledgebase->title}}
@endsection
@section('page-title')
    {{$knowledgebase->title}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$knowledgebase->meta_description}}">
    <meta name="tags" content="{{$knowledgebase->meta_tag}}">
@endsection
@section('content')
    <section class="knowledgebase-details-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-knowledgebase-details">
                        {!! $knowledgebase->content !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('knowledgebase',['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
