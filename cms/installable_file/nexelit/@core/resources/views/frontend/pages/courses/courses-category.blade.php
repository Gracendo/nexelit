@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('Category:')}} {{$category->lang_front->title}}
@endsection
@section('page-title')
    {{__('Category:')}} {{$category->lang_front->title}}
@endsection
@section('content')
    <section class="appointment-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                @php $a=1; @endphp
                @forelse($all_courses as $data)
                    <div class="col-lg-4 col-md-6">
                        <x-frontend.course.grid :course="$data" :increment="$a"/>
                    </div>
                    @php if($a == 4){ $a=1;}else{$a++;} @endphp
            @empty
                <div class="col-lg-12 text-center">
                    <div class="alert alert-warning">{{__('nothing found')}} <strong>{{$search_term}}</strong></div>
                </div>
            @endforelse
            <div class="col-lg-12 text-center">
                <nav class="pagination-wrapper " aria-label="Page navigation ">
                    {{$all_courses->links()}}
                </nav>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        (function($) {
            'use strict';
            $(document).on('change','select[name="sorting"]',function (e){
                e.preventDefault();
                $('input[name="sort"]').val($(this).val());
            })
            $(document).on('change','select[name="category"]',function (e){
                e.preventDefault();
                $('input[name="cat"]').val($(this).val());
            })
        })(jQuery);
    </script>
@endsection
