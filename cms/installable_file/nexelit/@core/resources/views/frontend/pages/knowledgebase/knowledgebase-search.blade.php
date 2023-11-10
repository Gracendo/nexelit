@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Search For:')}} {{$search_term}}
@endsection
@section('site-title')
    {{__('Search For:')}} {{$search_term}}
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @forelse($all_knowledgebase as $data)
                            <x-frontend.donation.grid :donation="$data" />
                        @empty
                            <div class="col-lg-12">
                                <div class="alert alert-warning d-block">{{__('No Article Found')}}</div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper text-center" aria-label="Page navigation ">
                            {{$all_knowledgebase->links()}}
                        </nav>
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
