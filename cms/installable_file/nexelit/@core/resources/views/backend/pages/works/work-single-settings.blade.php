@extends('backend.admin-master')
@section('site-title')
    {{__('Case Single Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Case Study Single Page Settings')}}</h4>
                        <form action="{{route('admin.work.single.page.settings')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach(get_all_language() as $key => $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#tab_{{$key}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                @foreach(get_all_language() as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$key}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="case_study_{{$lang->slug}}_read_more_text">{{__('Case Study Read More Button Text')}}</label>
                                            <input type="text" name="case_study_{{$lang->slug}}_read_more_text" class="form-control" value="{{get_static_option('case_study_'.$lang->slug.'_read_more_text')}}" id="case_study_{{$lang->slug}}_read_more_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="case_study_{{$lang->slug}}_related_title">{{__('Related Case Study Title')}}</label>
                                            <input type="text" name="case_study_{{$lang->slug}}_related_title" class="form-control" value="{{get_static_option('case_study_'.$lang->slug.'_related_title')}}" id="case_study_{{$lang->slug}}_related_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="case_study_{{$lang->slug}}_gallery_title">{{__('Case Study Gallery Title')}}</label>
                                            <input type="text" name="case_study_{{$lang->slug}}_gallery_title" class="form-control" value="{{get_static_option('case_study_'.$lang->slug.'_gallery_title')}}" id="case_study_{{$lang->slug}}_gallery_title">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

