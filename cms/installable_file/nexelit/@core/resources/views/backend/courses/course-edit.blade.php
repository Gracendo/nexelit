@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Course')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
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
                        <div class="header-wrap d-flex justify-content-between margin-bottom-30">
                            <h4 class="header-title">{{__('Edit Course')}}</h4>
                            <a href="{{route('admin.courses.all')}}" class="btn btn-info">{{__('All Courses')}}</a>
                        </div>
                        <form action="{{route('admin.courses.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$course->id}}">
                            <ul class="nav nav-tabs" role="tablist">
                                @php $default_lang = get_default_language(); @endphp
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($lang->slug == $default_lang) active @endif" data-lang="{{$lang->slug}}" data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-40" >
                                @foreach($all_languages as $lang)
                                    @php $currentLang = optional(optional($course->lang_query)->where(['lang'=> $lang->slug,'course_id' => $course->id]))->first();@endphp
                                    <div class="tab-pane fade @if($lang->slug == $default_lang) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="title">{{__('Title')}}</label>
                                            <input type="text" class="form-control title-field" name="title[{{$lang->slug}}]" value="{{$currentLang->title ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">{{__('Slug')}}</label>
                                            <input type="text" class="form-control slug-field"  name="slug[{{$lang->slug}}]" value="{{$currentLang->slug ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input type="hidden" name="description[{{$lang->slug}}]" value="{{$currentLang->description ?? ''}}">
                                            <div class="summernote" data-content='{{$currentLang->description ?? ''}}'></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title">{{__('Meta title')}}</label>
                                            <input type="text" class="form-control" name="meta_title[{{$lang->slug}}]" value="{{$currentLang->meta_title ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">{{__('Meta Description')}}</label>
                                            <textarea  class="form-control max-height-120" name="meta_description[{{$lang->slug}}]"cols="30" rows="10" placeholder="{{__('Meta Description')}}">{{$currentLang->meta_description ?? ''}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_tags">{{__('Meta Tags')}}</label>
                                            <input type="text" name="meta_tags[{{$lang->slug}}]"  class="form-control" data-role="tagsinput" value="{{$currentLang->meta_tags ?? ''}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_title">{{__('Og Meta title')}}</label>
                                            <input type="text" class="form-control" name="og_meta_title[{{$lang->slug}}]" placeholder="{{__('Og Meta title')}}" value="{{$currentLang->og_meta_title ?? ''}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="max_student">{{__('Maximum Student')}}</label>
                                <input type="number" class="form-control" name="max_student" value="{{$course->max_student}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('Price')}}</label>
                                <input type="number" class="form-control" name="price" value="{{$course->price}}">
                                <span class="info-text">{{__('enter 0 to make it free')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="sale_price">{{__('Sale Price')}}</label>
                                <input type="number" class="form-control" name="sale_price" value="{{$course->sale_price}}">
                            </div>
                            <div class="form-group">
                                <label for="external_url">{{__('External URL')}}</label>
                                <input type="text" class="form-control" name="external_url" value="{{$course->external_url}}">
                                <span class="info-text">{{__('it will goes to your enter url when anyone click into enroll button')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="duration">{{__('Duration')}}</label>
                                <input type="text" class="form-control" name="duration" value="{{$course->duration}}">
                            </div>
                            <div class="form-group">
                                <label for="duration_type">{{__('Duration Type')}}</label>
                                <select name="duration_type" class="form-control">
                                    <option @if($course->duration_type === 'min') selected @endif value="min">{{__('Minute')}}</option>
                                    <option @if($course->duration_type === 'hr') selected @endif value="hr">{{__('Hours')}}</option>
                                    <option @if($course->duration_type === 'days') selected @endif value="days">{{__('Days')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="featured"><strong>{{__('Featured')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="featured" @if($course->featured === 'yes') checked @endif>
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="enroll_required"><strong>{{__('Enroll Required')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="enroll_required" @if($course->enroll_required === 'yes') checked @endif >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <x-media-upload :name="'image'" :title="__('Image')" :id="$course->image" :dimentions="'1920x1080px'" />
                            <x-media-upload :name="'og_meta_image'" :title="__('Og Meta Image')" :id="$course->og_meta_image" :dimentions="'1920x1080px'" />

                            <div class="form-group">
                                <label for="categories_id">{{__('Category')}}</label>
                                <select name="categories_id" class="form-control nice-select wide">
                                    @foreach($all_categories as $cat)
                                        <option value="{{$cat->id}}" @if($course->categories_id == $cat->id) selected @endif>{{optional($cat->lang)->title ?? __('untitled')}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="instructor_id">{{__('Instructor')}}</label>
                                <select name="instructor_id" class="form-control nice-select wide">
                                    @foreach($all_instructor as $inst)
                                        <option value="{{$inst->id}}" @if($course->instructor_id == $inst->id) selected @endif>{{$inst->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control">
                                    <option @if($course->status === 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                                    <option @if($course->status === 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                                </select>
                            </div>
                            <div class="iconbox-repeater-wrapper dynamic-repeater">
                                <label for="additional_info" class="d-block">{{__('Curriculum')}} <span class="d-none"><i class="fas fa-spinner fa-spin"></i></span></label>
                            @forelse($all_curriculumn_with_lesson as $curricullumn_id => $curr_info)
                               <div class="curriculmn-outer-wrap">
                                   <div class="curriculmn-repeater-wrap">
                                       <div class="action-wrap">
                                           <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                           <span class="add"><i class="ti-plus"></i></span>
                                           <span class="remove"><i class="ti-trash"></i></span>
                                       </div>
                                       <input type="hidden" name="curriculmn__id" value="{{$curricullumn_id}}">
                                       <ul class="nav nav-tabs" role="tablist">
                                           @foreach($all_languages as $lang)
                                               <li class="nav-item">
                                                   <a class="nav-link @if($lang->slug == $default_lang) active @endif"  data-toggle="tab" href="#repeater_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                               </li>
                                           @endforeach
                                       </ul>
                                       <div class="tab-content" >
                                           @foreach($all_languages as $lang)
                                              @php 
                                              $lang_data =  $curr_info['curriculum'][$lang->slug] ?? '';
                                              $currul = isset($curr_info['curriculum']) ? $lang_data : '';  
                                              @endphp
                                              <div class="tab-pane fade @if($lang->slug == $default_lang) show active @endif" id="repeater_tab_{{$lang->slug}}" role="tabpanel" >
                                                  <div class="form-group">
                                                      <input type="text" class="form-control" name="curriculum_title[{{$curricullumn_id}}][{{$lang->slug}}]" placeholder="{{__('Curriculum title')}}" value="{{$currul['title'] ?? ''}}">
                                                  </div>
                                                  <div class="form-group">
                                                      <textarea  class="form-control max-height-120" name="curriculum_description[{{$curricullumn_id}}][{{$lang->slug}}]"cols="30" rows="10" placeholder="{{__('Curriculum description')}}">{{$currul['description'] ?? ''}}</textarea>
                                                  </div>
                                              </div>
                                          @endforeach
                                       </div>
                                   </div>
                                   @php $all_lessons =  $curr_info['lessons'] ?? [];  @endphp
                                   @forelse($all_lessons as $lesson_id => $lesson)
                                   @php $current_lesson = isset($curr_info['lessons']) ?  $curr_info['lessons'][$lesson_id][$default_lang] : '';  @endphp
                                   <div class="all-field-wrap lesson">
                                       <div class="form-group">
                                           <input type="text" class="form-control" name="course_lesson[{{$curricullumn_id}}][{{$lesson_id}}][]"  placeholder="{{__('create new lesson')}}" value="{{$current_lesson['title'] ?? __('untitled')}}">
                                       </div>
                                       <div class="action-wrap">
                                           <span class="edit"><a target="_blank" href="{{route('admin.courses.lesson.edit',$lesson_id)}}"><i class="ti-pencil"></i></a></span>
                                           <span class="add"><i class="ti-plus"></i></span>
                                           <span class="remove"><i class="ti-trash"></i></span>
                                       </div>
                                   </div>
                                   @empty
                                       <div class="all-field-wrap lesson">
                                           <div class="form-group">
                                               <input type="text" class="form-control" name="course_lesson[{{$curricullumn_id}}][]"  placeholder="{{__('create new lesson')}}">
                                           </div>

                                           <div class="action-wrap">
                                               <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                               <span class="add"><i class="ti-plus"></i></span>
                                               <span class="remove"><i class="ti-trash"></i></span>
                                           </div>
                                       </div>
                                   @endforelse

                               </div>
                                @empty
                                    <div class="curriculmn-outer-wrap">
                                        <div class="curriculmn-repeater-wrap">
                                            <div class="action-wrap">
                                                <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                                <span class="add"><i class="ti-plus"></i></span>
                                                <span class="remove"><i class="ti-trash"></i></span>
                                            </div>
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach($all_languages as $lang)
                                                    <li class="nav-item">
                                                        <a class="nav-link @if($lang->slug == $default_lang) active @endif"  data-toggle="tab" href="#repeater_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content" >
                                                @foreach($all_languages as $lang)
                                                    <div class="tab-pane fade @if($lang->slug == $default_lang) show active @endif" id="repeater_tab_{{$lang->slug}}" role="tabpanel" >
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="curriculum_title[1][{{$lang->slug}}]" placeholder="{{__('Curriculum title')}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea  class="form-control max-height-120" name="curriculum_description[1][{{$lang->slug}}]"cols="30" rows="10" placeholder="{{__('Curriculum description')}}"></textarea>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="all-field-wrap lesson">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="course_lesson[1][]"  placeholder="{{__('create new lesson')}}">
                                            </div>
                                            <div class="action-wrap">
                                                <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                                <span class="add"><i class="ti-plus"></i></span>
                                                <span class="remove"><i class="ti-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Save Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    @include('backend.partials.media-upload.media-js')
    @include('backend.partials.icon-field.js')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <x-backend.auto-slug-multilangual :url="route('admin.courses.slug.check')" :type="'update'" />
    <script>
        (function (){
            "use strict";

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }

            $(document).ready(function () {

                $('.summernote').summernote({
                    height: 400,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });

                $(document).on('click','.curriculmn-repeater-wrap > .action-wrap .remove',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $('.curriculmn-outer-wrap');

                    $(this).html('<i class="fas fa-spinner fa-spin"></i>');

                    if (container.length > 1){
                        el.show(300);
                        $.ajax({
                            type: 'POST',
                            url: "{{route('admin.courses.currilumn.ajax.delete')}}",
                            async: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                'curriculmn__id' :$(this).parent().parent().parent().find('input[name="curriculmn__id"]').val(),
                                'course_id' : $('input[name="id"]').val()
                            },
                            success: function (data){
                                // curcculmn_id = data;
                            }
                        });
                        parent.parent().hide(300).remove();
                    }else{
                        el.hide(300);
                    }
                    $(this).html('<i class="ti-trash"></i>');
                });

                $(document).on('click','.curriculmn-repeater-wrap > .action-wrap .add',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $('.curriculmn-repeater-wrap');
                    var clonedDiv = $(this).parent().parent().parent().clone();
                    var containerLength = container.length;
                    var allFields = clonedDiv.find('.form-control');

                    $(this).html('<i class="fas fa-spinner fa-spin"></i>');

                    var curcculmn_id = '';
                    var lession_id = '';
                    $.ajax({
                        type: 'POST',
                        url: "{{route('admin.courses.currilumn.ajax.create')}}",
                        async: false,
                        data: {
                            _token: "{{csrf_token()}}",
                            'course_id' : $('input[name="id"]').val()
                        },
                        success: function (data){
                            curcculmn_id = data.curriculum_id;
                            lession_id = data.lesson_id;
                        }
                    });

                    allFields.val('');
                    allFields.each(function (item,index){
                        var name = $(this).attr('name');
                        var number = name.replace(/\d+/g,curcculmn_id);
                        $(this).attr('name',number);
                    });

                    clonedDiv.find('.curriculmn-repeater-wrap > .action-wrap .remove').css({'display':'inline-block'});
                    clonedDiv.find('.all-field-wrap.lesson .action-wrap .edit').remove();
                    clonedDiv.find('.all-field-wrap.lesson').not(':first').remove();
                    //change lesson field name by curriculmn id and lesson id
                    clonedDiv.find('.all-field-wrap.lesson:first').find('input').attr('name','course_lesson['+curcculmn_id+']['+lession_id+'][]');
                    clonedDiv.find('.curriculmn-repeater-wrap').find('input[name="curriculmn__id"]').val(curcculmn_id);

                    var allTab =  clonedDiv.find('.tab-pane');

                    allTab.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('id');
                        el.attr('id',oldId+containerLength);
                    });
                    var allTabNav =  clonedDiv.find('.nav-link');
                    allTabNav.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('href');
                        el.attr('href',oldId+containerLength);
                    });
                    container.parent().parent().append(clonedDiv);
                    $(this).html('<i class="ti-plus""></i>');

                    if (container.length > 0){
                        parent.parent().find('.remove').show(300);
                    }
                });

                if($('.summernote').length > 0){
                    $('.summernote').each(function(index,value){
                        $(this).summernote('code', $(this).data('content'));
                    });
                }



                $(document).on('click','.all-field-wrap.lesson .action-wrap .add',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $('.all-field-wrap');
                    var clonedData = parent.clone();
                    var containerLength = container.length;
                    clonedData.find('#myTab').attr('id','mytab_'+containerLength);
                    clonedData.find('#myTabContent').attr('id','myTabContent_'+containerLength);
                    clonedData.find('.action-wrap .edit').remove();

                    var allFields = clonedData.find('.form-control');
                    var curriculmn_id = $(this).parent().parent().parent().find('input[name="curriculmn__id"]').val();
                    //add spinner in i
                    $(this).html('<i class="fas fa-spinner fa-spin"></i>');


                    //write code for new lesson id no. to detect new lesson

                    var lession_id = '';
                    $.ajax({
                        type: 'POST',
                        url: "{{route('admin.courses.lesson.ajax.new')}}",
                        async: false,
                        data: {
                            _token: "{{csrf_token()}}",
                            'course_id' : $('input[name="id"]').val(),
                            'curriculum_id' : curriculmn_id,
                        },
                        success: function (data){
                            lession_id = data;
                        }
                    });

                    allFields.val('');
                    allFields.each(function (item,index){
                        var name = $(this).attr('name');
                        // var number = name.replace(/\d+/g,lession_id);
                        $(this).attr('name','course_lesson['+curriculmn_id+']['+lession_id+'][]');
                    });

                    var allTab =  clonedData.find('.tab-pane');
                    allTab.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('id');
                        el.attr('id',oldId+containerLength);
                    });
                    var allTabNav =  clonedData.find('.nav-link');



                    allTabNav.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('href');
                        el.attr('href',oldId+containerLength);
                    });

                    parent.parent().append(clonedData);

                    if (containerLength > 0){
                        parent.parent().find('.remove').show(300);
                    }
                    parent.parent().find('.iconpicker-popover').remove();
                    parent.parent().find('.icp-dd').iconpicker();

                    $(this).html('<i class="ti-plus"></i>');
                });

                $(document).on('click','.all-field-wrap.lesson .action-wrap .remove',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $(this).parent().parent().parent().find('.all-field-wrap');
                    var lessonFieldName =  $(this).parent().parent().find('.form-control').attr('name');
                    var match = lessonFieldName.match(/\d+/g);
                    $(this).html('<i class="fas fa-spinner fa-spin"></i>');

                    //ajax call to delete lesson from db

                    $.ajax({
                        type: 'POST',
                        url: "{{route('admin.courses.lesson.ajax.delete')}}",
                        async: false,
                        data: {
                            _token: "{{csrf_token()}}",
                            'lesson_id' : match[1],
                        },
                        success: function (data){

                        }
                    });

                    if (container.length > 1){
                        el.show(300);
                        parent.hide(300).remove();
                    }else{
                        el.hide(300);
                    }
                });

            });


        })(jQuery);
    </script>


@endsection
