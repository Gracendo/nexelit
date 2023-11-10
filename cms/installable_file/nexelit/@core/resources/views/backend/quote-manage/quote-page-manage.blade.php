@extends('backend.admin-master')
@section('site-title')
    {{__('Quote Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Quote Page Settings')}}</h4>
                        <form action="{{route('admin.quote.page')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                    <a class="nav-item nav-link @if($key == 0) active @endif" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="quote_page_{{$lang->slug}}_form_title">{{__('Quote Form Title')}}</label>
                                        <input type="text" name="quote_page_{{$lang->slug}}_form_title" value="{{get_static_option('quote_page_'.$lang->slug.'_form_title')}}" class="form-control" id="quote_page_{{$lang->slug}}_form_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="quote_page_{{$lang->slug}}_form_button_text">{{__('Quote Form Button Text')}}</label>
                                        <input type="text" name="quote_page_{{$lang->slug}}_form_button_text" value="{{get_static_option('quote_page_'.$lang->slug.'_form_button_text')}}" class="form-control" id="quote_page_{{$lang->slug}}_form_button_text">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="quote_page_form_mail">{{__('Email Address For Quote Message')}}</label>
                                <input type="text" name="quote_page_form_mail" value="{{get_static_option('quote_page_form_mail')}}" class="form-control" id="quote_page_form_mail">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
