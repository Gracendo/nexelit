@extends('backend.admin-master')

@section('site-title')
    {{__('Section Manage')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Section Manage')}}</h4>
                        <form action="{{route('admin.homeone.section.manage')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_key_feature_section_status"><strong>{{__('Key Feature Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_key_feature_section_status"  @if(!empty(get_static_option('home_page_key_feature_section_status'))) checked @endif id="home_page_key_feature_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_about_us_section_status"><strong>{{__('About Us Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_about_us_section_status"  @if(!empty(get_static_option('home_page_about_us_section_status'))) checked @endif id="home_page_about_us_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_service_section_status"><strong>{{__('Service Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_service_section_status"  @if(!empty(get_static_option('home_page_service_section_status'))) checked @endif id="home_page_service_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_counterup_section_status"><strong>{{__('Counterup Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_counterup_section_status"  @if(!empty(get_static_option('home_page_counterup_section_status'))) checked @endif id="home_page_counterup_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_case_study_section_status"><strong>{{__('Case Study Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_case_study_section_status"  @if(!empty(get_static_option('home_page_case_study_section_status'))) checked @endif id="home_page_case_study_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_testimonial_section_status"><strong>{{__('Testimonial Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_testimonial_section_status"  @if(!empty(get_static_option('home_page_testimonial_section_status'))) checked @endif id="home_page_testimonial_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_latest_news_section_status"><strong>{{__('Latest News Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_latest_news_section_status"  @if(!empty(get_static_option('home_page_latest_news_section_status'))) checked @endif id="home_page_latest_news_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_brand_logo_section_status"><strong>{{__('Brand Logo Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_brand_logo_section_status"  @if(!empty(get_static_option('home_page_brand_logo_section_status'))) checked @endif id="home_page_brand_logo_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_support_bar_section_status"><strong>{{__('Support Bar Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_support_bar_section_status"  @if(!empty(get_static_option('home_page_support_bar_section_status'))) checked @endif id="home_page_support_bar_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="home_page_price_plan_section_status"><strong>{{__('Price Plan Section Show/Hide')}}</strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="home_page_price_plan_section_status"  @if(!empty(get_static_option('home_page_price_plan_section_status'))) checked @endif id="home_page_price_plan_section_status">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="home_page_team_member_section_status"><strong>{{__('Team Member Section Show/Hide')}}</strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="home_page_team_member_section_status"  @if(!empty(get_static_option('home_page_team_member_section_status'))) checked @endif id="home_page_team_member_section_status">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_call_to_action_section_status"><strong>{{__('Call To Action Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_call_to_action_section_status"  @if(!empty(get_static_option('home_page_call_to_action_section_status'))) checked @endif id="home_page_call_to_action_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_quality_section_status"><strong>{{__('Quality Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_quality_section_status"  @if(!empty(get_static_option('home_page_quality_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_contact_section_status"><strong>{{__('Contact Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_contact_section_status"  @if(!empty(get_static_option('home_page_contact_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_quote_faq_section_status"><strong>{{__('Quote & Faq Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_quote_faq_section_status"  @if(!empty(get_static_option('home_page_quote_faq_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_video_section_status"><strong>{{__('Video Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_video_section_status"  @if(!empty(get_static_option('home_page_video_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_expertice_section_status"><strong>{{__('Expertise Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_expertice_section_status"  @if(!empty(get_static_option('home_page_expertice_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_event_section_status"><strong>{{__('Events Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_event_section_status"  @if(!empty(get_static_option('home_page_event_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_appointment_section_status"><strong>{{__('Appointment Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_appointment_section_status"  @if(!empty(get_static_option('home_page_appointment_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_donation_cause_section_status"><strong>{{__('Donation Causes Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_donation_cause_section_status"  @if(!empty(get_static_option('home_page_donation_cause_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_work_process_section_status"><strong>{{__('Work Process Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_work_process_section_status"  @if(!empty(get_static_option('home_page_work_process_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_offer_section_status"><strong>{{__('Offer Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_offer_section_status"  @if(!empty(get_static_option('home_page_offer_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_featured_fruit_section_status"><strong>{{__('Featured Fruit Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_featured_fruit_section_status"  @if(!empty(get_static_option('home_page_featured_fruit_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_process_section_status"><strong>{{__('Process Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_process_section_status"  @if(!empty(get_static_option('home_page_process_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_online_store_section_status"><strong>{{__('Online Store Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_online_store_section_status"  @if(!empty(get_static_option('home_page_online_store_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_top_selling_section_status"><strong>{{__('Top Selling Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_top_selling_section_status"  @if(!empty(get_static_option('home_page_top_selling_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                @if($home_page_variant == '17')
                                <div class="col-lg-4">
                                    <x-backend.switcher :title="__('All Courses Section Show/Hide')" :name="'home_page_all_courses_section_status'"/>
                                </div>
                                <div class="col-lg-4">
                                    <x-backend.switcher :title="__('Featured Courses Section Show/Hide')" :name="'home_page_featured_courses_section_status'"/>
                                </div>
                                <div class="col-lg-4">
                                    <x-backend.switcher :title="__('Our Speciality Section Show/Hide')" :name="'home_page_our_speciality_section_status'"/>
                                </div>
                                <div class="col-lg-4">
                                    <x-backend.switcher :title="__('Our Speciality Section Show/Hide')" :name="'home_page_course_category_section_status'"/>
                                </div>
                                @endif
                                @if($home_page_variant == '18')
                                    <div class="col-lg-4">
                                        <x-backend.switcher :title="__('Product Categories Section Show/Hide')" :name="'home_page_product_category_section_status'"/>
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

