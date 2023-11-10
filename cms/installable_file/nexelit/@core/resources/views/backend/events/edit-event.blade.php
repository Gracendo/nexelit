@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Events Post')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('Edit Event Post')}}</h4>
                            <a href="{{route('admin.events.all')}}" class="btn btn-primary">{{__('All Events')}}</a>
                        </div>
                        <form action="{{route('admin.events.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="event_id" value="{{$event->id}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong>{{__('Language')}}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option @if($lang->slug == $event->lang) selected @endif value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="title" name="title" value="{{$event->title}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{__('Slug')}}</label>
                                        <input type="text" class="form-control"  id="slug" name="slug" value="{{$event->slug}}" placeholder="{{__('slug')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{__("Select Category")}}</option>
                                            @foreach($all_categories as $category)
                                                <option @if($category->id == $event->category_id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Content')}}</label>
                                        <input type="hidden" name="event_content" value="{{$event->content}}">
                                        <div class="summernote" data-content='{{$event->content}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">{{__('Date')}}</label>
                                        <input type="date" class="form-control" value="{{$event->date}}" id="date" name="date" >
                                    </div>
                                    <div class="form-group">
                                        <label for="time">{{__('Time')}}</label>
                                        <input type="text" class="form-control"  id="time" name="time" value="{{$event->time}}" placeholder="{{__('time')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="cost">{{__('Cost')}}</label>
                                        <input type="text" class="form-control"  id="cost" name="cost" value="{{$event->cost}}" placeholder="{{__('cost')}}">
                                        <span class="info-text">{{__('enter zero (0) to make this event free of cost')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="available_tickets">{{__('Available Tickets')}}</label>
                                        <input type="text" class="form-control"  id="available_tickets" value="{{$event->available_tickets}}" name="available_tickets" placeholder="{{__('available tickets')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer">{{__('Organizer')}}</label>
                                        <input type="text" class="form-control"  id="organizer" name="organizer" value="{{$event->organizer}}" placeholder="{{__('Event Organizer')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer_email">{{__('Organizer Email')}}</label>
                                        <input type="text" class="form-control"  id="organizer_email" name="organizer_email" value="{{$event->organizer_email}}" placeholder="{{__('Organizer Email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer_phone">{{__('Organizer Phone')}}</label>
                                        <input type="text" class="form-control"  id="organizer_phone" name="organizer_phone" value="{{$event->organizer_phone}}" placeholder="{{__('Organizer Phone')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="organizer_website">{{__('Organizer Website')}}</label>
                                        <input type="text" class="form-control"  id="organizer_website" name="organizer_website" value="{{$event->organizer_website}}" placeholder="{{__('Organizer Website')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="venue">{{__('Venue')}}</label>
                                        <input type="text" class="form-control"  id="venue" name="venue" value="{{$event->venue}}" placeholder="{{__('Event Venue')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="venue_location">{{__('Venue Location')}}</label>
                                        <input type="text" class="form-control"  id="venue_location" name="venue_location" value="{{$event->venue_location}}" placeholder="{{__('Venue Location')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="venue_phone">{{__('Venue Phone')}}</label>
                                        <input type="text" class="form-control"  id="venue_phone" name="venue_phone" value="{{$event->venue_phone}}" placeholder="{{__('Venue Phone')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">{{__('Meta Tags')}}</label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" value="{{$event->meta_tags}}" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">{{__('Meta Description')}}</label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description">{{$event->meta_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{__('Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $event_img = get_attachment_image_by_id($event->image,null,false);
                                                    $event_img_btn_label = 'Upload Image';
                                                @endphp
                                                @if (!empty($event_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="{{$event_img['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php  $event_img_btn_label = 'Change Image'; @endphp
                                                @endif
                                            </div>
                                            <input type="hidden" name="image" value="{{$event->image}}">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Event Image')}}" data-modaltitle="{{__('Upload Event Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{$event_img_btn_label}}
                                            </button>
                                        </div>
                                        <small>{{__('Recommended image size 1920x1280')}}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" id="status"  class="form-control">
                                            <option @if($event->status == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                                            <option @if($event->status == 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Event')}}</button>
                                </div>
                            </div>
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
    <x-backend.auto-slug-js :url="route('admin.events.slug.check')" :type="'update'"/>
    <script>
        $(document).ready(function () {

            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "{{route('admin.events.category.by.lang')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category').html('<option value="">{{__('Select Category')}}</option>');
                        $.each(data,function(index,value){
                            $('#category').append('<option value="'+value.id+'">'+value.title+'</option>')
                        });
                    }
                });
            });

            $('.summernote').summernote({
                height: 500,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        });
    </script>

    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
