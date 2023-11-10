@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('Apply To').' '}}{{$job->title}}
@endsection
@section('page-title')
    {{__('Apply To').' '}}{{$job->title}}
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="job-apply-form-wrapper">
                        @include('backend.partials.message')
                        @if($errors->any())
                            <ul class="alert alert-danger">
                            @foreach($errors->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                            </ul>
                        @endif
                        <h2 class="job-apply-title"> {{__('Apply To').' '}}{{$job->title}}</h2>
                        <form action="{{route('frontend.jobs.apply.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="{{__('Your Name')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="{{__('Your Email')}}" class="form-control">
                            </div>
                            {!! render_form_field_for_frontend(get_static_option('apply_job_page_form_fields')) !!}
                            @if(!empty($job->application_fee_status) && $job->application_fee > 0)
                                <input type="hidden" name="application_fee" value="{{$job->application_fee}}">
                            {!! render_payment_gateway_for_form()!!}
                             @if(!empty(get_static_option('manual_payment_gateway')))
                                <div class="form-group manual_payment_transaction_field @if( get_static_option('site_default_payment_gateway') === 'manual_payment') d-block @endif " >
                                    <div class="label mb-2">{{__('Attach your bank Document')}}</div>
                                    <input class="form-control btn btn-primary btn-sm p-2" type="file" name="manual_payment_attachment">
                                    <span class="help-info mt-2">{!! get_manual_payment_description() !!}</span>
                                </div>
                            @endif
                            @endif
                           
                            <div class="btn-wrapper text-center">
                                <button class="boxed-btn style-01" type="submit">{{__('Apply')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            "use strict";

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway === 'manual_payment'){
                    $('.manual_payment_transaction_field').addClass('d-block').removeClass('d-none');
                }else{
                    $('.manual_payment_transaction_field').addClass('d-none').removeClass('d-block');
                }
                $('.payment-gateway-wrapper').find(('input')).val(gateway);
            });
        });
    </script>
@endsection
