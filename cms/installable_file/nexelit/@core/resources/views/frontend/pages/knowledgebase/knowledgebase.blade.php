@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('knowledgebase_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="knowledgebase-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="main-title">{{get_static_option('site_knowledgebase_article_topic_'.$user_select_lang_slug.'_title')}}</h4>
                    <div class="row">
                        @foreach($all_knowledgebase as $topic => $articles)
                            <div class="col-lg-6">
                                <div class="article-with-topic-title-style-01">
                                    @if(!empty(get_topic_name_by_id($topic)))
                                    <a href="{{route('frontend.knowledgebase.category',['id' => $topic,'any' => Str::slug(get_topic_name_by_id($topic)) ])}}"> <h4 class="topic-title"><i class="fas fa-folder"></i> {{get_topic_name_by_id($topic)}}</h4></a>
                                    @endif
                                    <ul class="know-articles-list">
                                        @foreach($articles as $art)
                                        <li><a href="{{route('frontend.knowledgebase.single',$art->slug)}}"><i class="far fa-file-alt"></i> {{$art->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
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
