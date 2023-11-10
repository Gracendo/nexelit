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
                        @forelse($all_jobs as $data)
                            <div class="col-lg-12">
                                <x-frontend.job.grid :job="$data" />
                            </div>
                        @empty
                            <div class="col-lg-12">
                                <div class="alert alert-warning d-block">{{__('No Job Posts Found')}}</div>
                            </div>
                        @endforelse
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper text-center" aria-label="Page navigation ">
                            {{$all_jobs->links()}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('career',['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
