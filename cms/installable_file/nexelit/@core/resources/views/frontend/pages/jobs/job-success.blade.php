@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Success For:').' '.$job_details->title}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-50">
                        <h1 class="title">{{get_static_option('job_success_page_' . $user_select_lang_slug . '_title')}}</h1>
                        <p>{{get_static_option('job_success_page_' . $user_select_lang_slug . '_description')}}</p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <h2 class="billing-title">{{__('Billing Details')}}</h2>
                    <ul class="billing-details">
                        <li><strong>{{__('Applicant ID')}}:</strong> #{{$applicant_details->id}}</li>
                        <li><strong>{{__('Name')}}:</strong> {{$applicant_details->name}}</li>
                        <li><strong>{{__('Email')}}:</strong> {{$applicant_details->email}}</li>
                        <li><strong>{{__('Payment Method')}}:</strong> {{str_replace('_',' ',$applicant_details->payment_gateway)}}</li>
                        <li><strong>{{__('Payment Status')}}:</strong> {{$applicant_details->payment_status}}</li>
                        <li><strong>{{__('Transaction id')}}:</strong> {{$applicant_details->transaction_id}}</li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="job-single-wrap">
                        <div class="single-job-list-item">
                            <span class="job_type"><i class="far fa-clock"></i> {{str_replace('_',' ',__($job_details->employment_status))}}</span>
                            <a href="{{route('frontend.jobs.single',$job_details->slug)}}"><h3 class="title">{{$job_details->title}}</h3></a>
                            <span class="company_name"><strong>{{__('Company:')}}</strong> {{$job_details->company_name}}</span>
                            <span class="deadline"><strong>{{__('Deadline:')}}</strong> {{date("d M Y", strtotime($job_details->deadline))}}</span>
                            <ul class="jobs-meta">
                                <li><i class="fas fa-briefcase"></i> {{$job_details->position}}</li>
                                <li><i class="fas fa-wallet"></i> {{$job_details->salary}}</li>
                                <li><i class="fas fa-map-marker-alt"></i> {{$job_details->job_location}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
