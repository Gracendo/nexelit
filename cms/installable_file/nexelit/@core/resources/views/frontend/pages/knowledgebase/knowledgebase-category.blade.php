@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('site-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($all_knowledgebase as $data)
                                <x-frontend.donation.grid :donation="$data" />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper text-center" aria-label="Page navigation ">
                            {{$all_knowledgebase->links()}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="widget widget_search">
                            <form action="{{route('frontend.knowledgebase.search')}}" method="get" class="search-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="{{__('Search...')}}">
                                </div>
                                <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_nav_menu">
                            <h2 class="widget-title">{{get_static_option('site_knowledgebase_category_'.$user_select_lang_slug.'_title')}}</h2>
                            <ul>
                                @foreach($all_knowledgebase_category as $data)
                                    <li><a href="{{route('frontend.knowledgebase.category',['id' => $data->id,'any'=> Str::slug($data->title,'-')])}}"><i class="fas fa-folder base-color"></i> {{ucfirst($data->title)}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_nav_menu">
                            <h2 class="widget-title">{{get_static_option('site_knowledgebase_popular_widget_'.$user_select_lang_slug.'_title')}}</h2>
                            <ul>
                                @foreach($popular_articles as $data)
                                    <li><a href="{{route('frontend.knowledgebase.single',$data->slug)}}"><i class="far fa-file-alt base-color"></i> {{ucfirst($data->title)}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
