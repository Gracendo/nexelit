@extends('backend.admin-master')
@section('site-title')
    {{__('Site Identity')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Site Identity Settings")}}</h4>
                        <form action="{{route('admin.general.site.identity')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <x-media-upload :name="'site_logo'" :dimentions="'160x50'" :title="__('Site Logo')"/>
                            <x-media-upload :name="'site_white_logo'" :dimentions="'160x50'" :title="__('White Site Logo')"/>
                            <x-media-upload :name="'site_favicon'" :dimentions="'40x40'" :title="__('Favicon')"/>
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
@endsection

