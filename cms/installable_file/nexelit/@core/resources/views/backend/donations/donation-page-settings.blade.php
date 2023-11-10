@extends('backend.admin-master')
@section('site-title')
    {{__('Donation Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Donation Page Settings")}}</h4>
                        <form action="{{route('admin.donations.page.settings')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="donation_button_{{$lang->slug}}_text">{{__('Donation Button Text')}}</label>
                                            <input type="text" name="donation_button_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('donation_button_'.$lang->slug.'_text')}}" id="donation_button_{{$lang->slug}}_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="donation_raised_{{$lang->slug}}_text">{{__('Raised Text')}}</label>
                                            <input type="text" name="donation_raised_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('donation_raised_'.$lang->slug.'_text')}}" id="donation_raised_{{$lang->slug}}_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="donation_goal_{{$lang->slug}}_text">{{__('Goal Text')}}</label>
                                            <input type="text" name="donation_goal_{{$lang->slug}}_text"  class="form-control" value="{{get_static_option('donation_goal_'.$lang->slug.'_text')}}" id="donation_goal_{{$lang->slug}}_text">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="site_events_post_items">{{__('Donation Items')}}</label>
                                <input type="text" name="donor_page_post_items"  class="form-control" value="{{get_static_option('donor_page_post_items')}}" id="donor_page_post_items">
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
