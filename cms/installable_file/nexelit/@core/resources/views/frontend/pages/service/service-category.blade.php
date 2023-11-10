@extends('frontend.frontend-page-master')
@section('page-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}} {{__('Category:')}} {{$category_name}}
@endsection
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}} {{__('Category:')}} {{$category_name}}
@endsection
@section('content')
    <section class="blog-content-area padding-100">
        <div class="container">
            <div class="row">
                @if(empty($service_items))
                    <div class="col-lg-12">
                        <div class="alert alert-danger">{{__('No Post Available In This Category')}}</div>
                    </div>
                @endif
                    @php $a = 1; @endphp
                    @foreach($service_items as $data)
                        <div class="col-lg-4 col-md-6">
                            <x-frontend.service.grid :increment="$a" :service="$data"/>
                        </div>
                        @php  if($a == 4){ $a = 1;}else{$a++;}; @endphp
                    @endforeach
                <nav class="pagination-wrapper" aria-label="Page navigation">
                    {{$service_items->links()}}
                </nav>
            </div>
        </div>
    </section>
@endsection
