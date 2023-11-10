@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}} {{__('Category:')}} {{$cat_name}}
@endsection
@section('page-title')
    {{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}} {{__('Category:')}} {{$cat_name}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="appointment-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                        @forelse($all_appointment as $data)
                        <div class="col-lg-4">
                            <x-frontend.appointment.grid :appointment="$data"/>
                        </div>
                        @empty
                        <div class="col-lg-12 text-center">
                           <div class="alert alert-warning">{{__('nothing found')}} <strong>{{$search_term}}</strong></div>
                        </div>
                        @endforelse
                <div class="col-lg-12 text-center">
                    <nav class="pagination-wrapper " aria-label="Page navigation ">
                        {{$all_appointment->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
