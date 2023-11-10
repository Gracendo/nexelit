@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Appointment')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
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
                            <h4 class="header-title">{{__('Edit Appointment')}}</h4>
                            <a href="{{route('admin.appointment.all')}}" class="btn btn-info">{{__('All Appointments')}}</a>
                        </div>
                        <form action="{{route('admin.appointment.update')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="{{$item->id}}" name="id">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @php $default_lang = get_default_language(); @endphp
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($lang->slug == $default_lang) active @endif" data-lang="{{$lang->slug}}"  data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-40" >
                                @foreach($item->lang_all as $appointment)
                                    <div class="tab-pane fade @if($appointment->lang == $default_lang) show active @endif" id="slider_tab_{{$appointment->lang}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="title">{{__('Title')}}</label>
                                            <input type="text" class="form-control title-field" name="title[{{$appointment->lang}}]" value="{{$appointment->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">{{__('Slug')}}</label>
                                            <input type="text" class="form-control slug-field" name="slug[{{$appointment->lang}}]" value="{{$appointment->slug}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">{{__('Designation')}}</label>
                                            <input type="text" class="form-control"  name="designation[{{$appointment->lang}}]" value="{{$appointment->designation}}" >
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input type="hidden" name="description[{{$appointment->lang}}]" value="{{$appointment->description}}">
                                            <div class="summernote" data-content='{{$appointment->description}}'></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="location">{{__('Location')}}</label>
                                            <input type="text" name="location[{{$appointment->lang}}]" class="form-control" value="{{$appointment->location}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="short_description">{{__('Short Description')}}</label>
                                            <textarea name="short_description[{{$appointment->lang}}]" cols="30" rows="5" class="form-control" placeholder="{{__('Short Description')}}">{{$appointment->short_description}}</textarea>
                                        </div>

                                        <div class="iconbox-repeater-wrapper dynamic-repeater">
                                            <label for="additional_info" class="d-block">{{__('Additional Info')}}</label>

                                            @forelse($appointment->additional_info as $add_info)
                                            <div class="all-field-wrap">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="additional_info[{{$appointment->lang}}][]"  value="{{$add_info}}" placeholder="{{__('additional info')}}">
                                                </div>
                                                <div class="action-wrap">
                                                    <span class="add"><i class="ti-plus"></i></span>
                                                    <span class="remove"><i class="ti-trash"></i></span>
                                                </div>
                                            </div>
                                            @empty
                                                <div class="all-field-wrap">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="additional_info[{{$appointment->lang}}][]"  placeholder="{{__('additional info')}}">
                                                    </div>
                                                    <div class="action-wrap">
                                                        <span class="add"><i class="ti-plus"></i></span>
                                                        <span class="remove"><i class="ti-trash"></i></span>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>

                                        <div class="iconbox-repeater-wrapper  dynamic-repeater">
                                            <label for="experience_info" class="d-block">{{__('Experience Info')}}</label>
                                            @forelse($appointment->experience_info as $add_info)
                                            <div class="all-field-wrap">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="experience_info[{{$appointment->lang}}][]" placeholder="{{__('Experience Info')}}" value="{{$add_info}}">
                                                </div>
                                                <div class="action-wrap">
                                                    <span class="add"><i class="ti-plus"></i></span>
                                                    <span class="remove"><i class="ti-trash"></i></span>
                                                </div>
                                            </div>
                                            @empty
                                                <div class="all-field-wrap">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="experience_info[{{$appointment->lang}}][]" placeholder="{{__('Experience Info')}}">
                                                    </div>
                                                    <div class="action-wrap">
                                                        <span class="add"><i class="ti-plus"></i></span>
                                                        <span class="remove"><i class="ti-trash"></i></span>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                        <div class="iconbox-repeater-wrapper  dynamic-repeater">
                                            <label for="specialized_info" class="d-block">{{__('Specialized Info')}}</label>

                                            @forelse($appointment->specialized_info as $add_info)
                                            <div class="all-field-wrap">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="specialized_info[{{$appointment->lang}}][]" placeholder="{{__('Specialized Info')}}" value="{{$add_info}}">
                                                </div>
                                                <div class="action-wrap">
                                                    <span class="add"><i class="ti-plus"></i></span>
                                                    <span class="remove"><i class="ti-trash"></i></span>
                                                </div>
                                            </div>
                                            @empty
                                                <div class="all-field-wrap">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="specialized_info[{{$appointment->lang}}][]"  placeholder="{{__('Specialized Info')}}">
                                                    </div>
                                                    <div class="action-wrap">
                                                        <span class="add"><i class="ti-plus"></i></span>
                                                        <span class="remove"><i class="ti-trash"></i></span>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_title">{{__('Meta title')}}</label>
                                            <input type="text" class="form-control" name="meta_title[{{$appointment->lang}}]" placeholder="{{__('Meta title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">{{__('Meta Description')}}</label>
                                            <textarea  class="form-control max-height-120" name="meta_description[{{$appointment->lang}}]"cols="30" rows="10" placeholder="{{__('Meta Description')}}"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_tags">{{__('Meta Tags')}}</label>
                                            <input type="text" name="meta_tags[{{$appointment->lang}}]"  class="form-control" data-role="tagsinput" {{$appointment->lang}}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{__("Select Category")}}</option>
                                            @foreach($all_category as $category)
                                                <option value="{{$category->id}}" @if($category->id == $item->categories_id) selected @endif>{{optional($category->lang_front)->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="booking_time_ids">{{__('Booking Time')}}</label>
                                        <input type="hidden" name="booking_time_ids" value="{{implode(',',array_column($item->booking_time_ids,'id'))}}">
                                        <ul class="time_slot">
                                            @forelse($all_booking_time as $data)
                                                <li data-id="{{$data->id}}" @if(in_array($data->id,array_column($item->booking_time_ids,'id'))) class="selected" @endif >{{$data->time}}</li>
                                            @empty
                                                <li>{{__('add appointment time first')}}</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_appointment">{{__('Max Appointment')}}</label>
                                        <input type="number" name="max_appointment" class="form-control" value="{{$item->max_appointment}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">{{__('Price')}}</label>
                                        <input type="number" name="price" value="{{$item->price}}" class="form-control">
                                    </div>

                                    <x-media-upload :name="'image'" :title="__('Image')" :id="$item->image" :dimentions="'350x500'"/>
                                    <div class="form-group">
                                        <label for="appointment_status"><strong>{{__('Available For Appointment')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="appointment_status" @if($item->appointment_status) checked @endif>
                                            <span class="slider onff"></span>
                                        </label>
                                    </div>

                                    <x-backend.status-field :name="'status'" :value="$item->status" :title="__('Status')"/>
                                    <button type="submit"
                                            class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit')}}</button>
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
    @include('backend.partials.repeater.script')
    <x-backend.auto-slug-multilangual :url="route('admin.appointment.slug.check')" :type="'update'" />
    <script>
        $(document).ready(function () {
            $(document).on('click','ul.time_slot li',function (e){
                e.preventDefault();
                //prent selector
                var parent = $(this).parent().parent();
                //append input field value by this id
                var ids = parent.find('input[name="booking_time_ids"]');
                var oldValue = ids.val()
                //assign new value =
                var id = $(this).data('id');
                if(oldValue != ''){
                    var oldValAr = oldValue.split(',');
                    if($(this).hasClass('selected')){
                        var oldValAr = oldValAr.filter(function (item){return item != id;});
                    }else{
                        oldValAr.push(id);
                    }
                    ids.val(oldValAr.toString());
                }else{
                    ids.val(id);
                }
                //add class for this li
                $(this).toggleClass('selected');
            });
            $(document).on('change', '#language', function (e) {
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "{{route('admin.appointment.category.by.lang')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        lang: selectedLang
                    },
                    success: function (data) {
                        $('#category').html('<option value="">{{__("Select Category")}}</option>');
                        $.each(data, function (index, value) {
                            $('#category').append('<option value="' + value.id + '">' + value.title + '</option>')
                        });
                    }
                });
            });
            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function (contents, $editable) {
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
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
