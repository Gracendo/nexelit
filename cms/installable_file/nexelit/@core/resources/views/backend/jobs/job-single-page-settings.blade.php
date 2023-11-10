@extends('backend.admin-master')
@section('site-title')
    {{__('Job Single Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Job Single Page Settings")}}</h4>
                        <form action="{{route('admin.jobs.single.page.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_context_label">{{__('Job Context Label')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_context_label"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_context_label')}}" id="job_single_page_{{$lang->slug}}_job_context_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_responsibility_label">{{__('Job Responsibility Label')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_responsibility_label"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_responsibility_label')}}" id="job_single_page_{{$lang->slug}}_job_responsibility_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_education_requirement_label">{{__('Education Requirement Label')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_education_requirement_label"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_education_requirement_label')}}" id="job_single_page_{{$lang->slug}}_education_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_experience_requirement_label">{{__('Experience Requirement Label')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_experience_requirement_label"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_experience_requirement_label')}}" id="job_single_page_{{$lang->slug}}_experience_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_additional_requirement_label">{{__('Additional Requirement Label')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_additional_requirement_label"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_additional_requirement_label')}}" id="job_single_page_{{$lang->slug}}_additional_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_others_benefits_label">{{__('Others Benefits Label')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_others_benefits_label"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_others_benefits_label')}}" id="job_single_page_{{$lang->slug}}_others_benefits_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_apply_button_text">{{__('Job Apply Button Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_apply_button_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_apply_button_text')}}" id="job_single_page_{{$lang->slug}}_apply_button_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_info_text">{{__('Job Information Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_info_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_info_text')}}" id="job_single_page_{{$lang->slug}}_job_info_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_company_name_text">{{__('Company Name Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_company_name_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_company_name_text')}}" id="job_single_page_{{$lang->slug}}_company_name_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_category_text">{{__('Job Category Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_category_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_category_text')}}" id="job_single_page_{{$lang->slug}}_job_category_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_position_text">{{__('Job Position Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_position_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_position_text')}}" id="job_single_page_{{$lang->slug}}_job_position_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_type_text">{{__('Job Type Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_type_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_type_text')}}" id="job_single_page_{{$lang->slug}}_job_type_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_salary_text">{{__('Salary Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_salary_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_salary_text')}}" id="job_single_page_{{$lang->slug}}_salary_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_location_text">{{__('Job Location Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_location_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_location_text')}}" id="job_single_page_{{$lang->slug}}_job_location_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_deadline_text">{{__('Deadline Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_deadline_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_deadline_text')}}" id="job_single_page_{{$lang->slug}}_job_deadline_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_{{$lang->slug}}_job_application_fee_text">{{__('Application Fee Text')}}</label>
                                            <input type="text" name="job_single_page_{{$lang->slug}}_job_application_fee_text"  class="form-control" value="{{get_static_option('job_single_page_'.$lang->slug.'_job_application_fee_text')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_applicant_mail">{{__('Job Application Receiving Mail')}}</label>
                                <input type="text" name="job_single_page_applicant_mail"  class="form-control" value="{{get_static_option('job_single_page_applicant_mail')}}" id="job_single_page_applicant_mail">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_apply_form"><strong>{{__('Apply Page Enable/Disable')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="job_single_page_apply_form"  @if(!empty(get_static_option('job_single_page_apply_form'))) checked @endif id="job_single_page_apply_form">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
