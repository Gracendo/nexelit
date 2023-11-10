@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('site-title')
    {{__('Edit Case Study')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('Edit Case Study')}}</h4>
                            <a href="{{route('admin.work')}}" class="btn btn-primary">{{__('All Case Study')}}</a>
                        </div>
                        <form action="{{route('admin.work.update')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$work_details->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="language">{{__('Language')}}</label>
                                <select name="lang" id="language" class="form-control">
                                    @foreach(get_all_language() as $language)
                                        <option  @if($language->slug == $work_details->lang) selected @endif value="{{$language->slug}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control"  id="title"  name="title" value="{{$work_details->title}}">
                            </div>
                            <div class="form-group">
                                <label for="slug">{{__('Slug')}}</label>
                                <input type="text" class="form-control"  id="slug"  name="slug" value="{{$work_details->slug}}">
                            </div>
                            <div class="form-group">
                                <label for="clients">{{__('Clients')}}</label>
                                <input type="text" class="form-control"  id="clients"  name="clients" value="{{$work_details->clients}}">
                            </div>
                            <div class="form-group">
                                <label for="duration">{{__('Duration')}}</label>
                                <input type="text" class="form-control"  id="duration"  name="duration" value="{{$work_details->duration}}">
                            </div>
                            <div class="form-group">
                                <label for="budget">{{__('Budget')}}</label>
                                <input type="text" class="form-control"  id="budget"  name="budget" value="{{$work_details->budget}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <input type="hidden" name="description" id="description" value="{{$work_details->description}}">
                                <div class="summernote" data-content='{{$work_details->description}}'></div>
                            </div>
                            <div class="form-group">
                                <label for="excerpt">{{__('Excerpt')}}</label>
                                <textarea name="excerpt"  class="form-control" rows="5" id="excerpt">{{$work_details->excerpt}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories_id">{{__('Category')}}</label>
                                @php
                                    $all_category = $work_details->categories_id;
                                @endphp
                                <select name="categories_id[]" multiple id="category" class="form-control nice-select wide">
                                    @foreach($works_category as $data)
                                        <option @if(in_array($data->id,$all_category)) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="meta_tags">{{__('Meta Tags')}}</label>
                                <input type="text" name="meta_tags" value="{{$work_details->meta_tag}}" class="form-control" data-role="tagsinput" id="meta_tags">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">{{__('Meta Description')}}</label>
                                <textarea name="meta_description"  class="form-control" rows="5" id="meta_description">{{$work_details->meta_description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">{{__('Gallery')}}</label>
                                @php
                                    $gallery_images = !empty( $work_details->gallery) ? explode('|', $work_details->gallery) : [];
                                @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @foreach($gallery_images as $gl_img)
                                            @php
                                                $work_section_img = get_attachment_image_by_id($gl_img,null,true);
                                            @endphp
                                            @if (!empty($work_section_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$work_section_img['img_url']}}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="gallery" value="{{$work_details->gallery}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__('Upload Image')}}
                                    </button>
                                </div>
                                <small>{{__('Recommended image size 1920x1280')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" id="status" class="form-control">
                                    <option @if($work_details->status == 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                                    <option @if($work_details->status == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                                </select>
                            </div>
                            <x-media-upload :id="$work_details->image" :name="'image'" :dimentions="'1920x1280'" :title="__('Image')"/>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Case Study')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <x-backend.auto-slug-js :url="route('admin.work.slug.check')" :type="'update'"/>
    <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }
            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            $(document).on('change','#language',function (e) {
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url : "{{route('admin.work.category.by.slug')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang: selectedLang
                    },
                    success:function (data) {
                        $('#category').html('');
                        $.each(data,function (index,value) {
                            $('#category').append('<option value="'+value.id+'">'+value.name+'</option>');
                            $('.nice-select').niceSelect('update');
                        });
                    }
                });
            });
        });
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
