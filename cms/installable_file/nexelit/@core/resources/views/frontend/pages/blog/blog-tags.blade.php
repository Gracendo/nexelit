@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Tags:')}} {{' '.$tag_name}}
@endsection
@section('site-title')
    {{__('Tags:')}} {{' '.$tag_name}}
@endsection
@section('content')
    <section class="blog-content-area padding-120 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if(count($all_blogs) < 1)
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            {{__('No Post Available In').' '.$tag_name.__(' Tags')}}
                        </div>
                    </div>
                @endif
                    @foreach($all_blogs as $data)
                            <x-frontend.blog.grid :blog="$data" :margin="true"/>
                    @endforeach
                    <nav class="pagination-wrapper" aria-label="Page navigation ">
                       {{$all_blogs->links()}}
                    </nav>
                </div>
                <div class="col-lg-4">
                   @include('frontend.pages.blog.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
