@extends('backend.admin-master')
@section('site-title')
    {{__('Donation Single Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                 @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Donation Single Page Settings")}}</h4>
                        <form action="{{route('admin.donations.single.page.settings')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="donation_single_{{$lang->slug}}_form_title">{{__('Donation Form Title')}}</label>
                                            <input type="text" name="donation_single_{{$lang->slug}}_form_title"  class="form-control" value="{{get_static_option('donation_single_'.$lang->slug.'_form_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="donation_single_{{$lang->slug}}_form_button_text">{{__('Form Button Title')}}</label>
                                            <input type="text" name="donation_single_{{$lang->slug}}_form_button_text"  class="form-control" value="{{get_static_option('donation_single_'.$lang->slug.'_form_button_text')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="donation_single_{{$lang->slug}}_recent_donation_text">{{__('Recent Donation Title')}}</label>
                                            <input type="text" name="donation_single_{{$lang->slug}}_recent_donation_text"  class="form-control" value="{{get_static_option('donation_single_'.$lang->slug.'_recent_donation_text')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="donation_custom_amount">{{__('Custom Donation Amount')}}</label>
                                <input type="text" name="donation_custom_amount"  class="form-control" value="{{get_static_option('donation_custom_amount')}}" id="donation_custom_amount">
                                <p>{{__('Separate amount by comma (,)')}}</p>
                            </div>
                            <div class="form-group">
                                <label for="donation_default_amount">{{__('Default Donation Amount')}}</label>
                                <input type="text" name="donation_default_amount"  class="form-control" value="{{get_static_option('donation_default_amount')}}" id="donation_default_amount">
                            </div>
                            <div class="form-group">
                                <label for="donation_notify_mail">{{__('Donation Notify Email')}}</label>
                                <input type="text" name="donation_notify_mail"  class="form-control" value="{{get_static_option('donation_notify_mail')}}" id="donation_notify_mail">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
