@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Email Template')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Email Template")}}</h4>
                        <x-error-msg/>
                        <x-flash-msg/>
                        <form action="{{route('admin.general.email.template')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_global_email">{{__('Global Email')}}</label>
                                <input type="text" name="site_global_email"  class="form-control" value="{{get_static_option('site_global_email')}}" id="site_global_email">
                                <small class="form-text text-muted">use your web mail here</small>
                            </div>
                            <div class="form-group">
                                <label for="site_global_email_template">{{__('Email Template')}}</label>
                                <input type="hidden" name="site_global_email_template"  class="form-control" value="{{get_static_option('site_global_email_template')}}" id="site_global_email_template">
                                <div class="summernote" data-content='{{get_static_option("site_global_email_template")}}'></div>
                                <small class="form-text text-muted">@username {{__('Will replace by username of user and')}} @company {{__('will be replaced by site title also')}} @message {{__('will be replaced by dynamically with message.')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script>

        $(document).ready(function(){

            var summerNote = $('.summernote');
            summerNote.summernote({
                height: 150,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if(summerNote.length ){
                summerNote.each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        })

    </script>
@endsection
