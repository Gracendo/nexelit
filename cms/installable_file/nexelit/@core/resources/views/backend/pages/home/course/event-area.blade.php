@extends('backend.admin-master')
@section('site-title')
    {{__('Event Area')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-flash-msg/>
               <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Event Area Settings')}}</h4>
                        <form action="{{route('admin.home17.all.event.area')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                @foreach($all_languages as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#home_{{$key}}" role="tab" aria-selected="true">{{$lang->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="home_{{$key}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="course_home_page_{{$lang->slug}}_event_area_title">{{__('Title')}}</label>
                                        <input type="text" name="course_home_page_{{$lang->slug}}_event_area_title" class="form-control" value="{{get_static_option('course_home_page_'.$lang->slug.'_event_area_title')}}" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_event_area_items">{{__('Event Items')}}</label>
                                <input type="text" name="home_page_01_event_area_items" class="form-control"
                                       value="{{get_static_option('home_page_01_event_area_items')}}"
                                       id="home_page_01_event_area_items">
                                <small class="info-text">{{__('enter how many event show in frontend')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection