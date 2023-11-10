@extends('backend.admin-master')
@section('site-title')
    {{__('Header Slider')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
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

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Header Slider')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_header_slider as $key => $slider)

                            <li class="nav-item">
                                <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                            </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_header_slider as $key => $slider)
                            <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab_{{$key}}" role="tabpanel" >
                               <div class="table-wrap table-responsive">
                                   <table class="table table-default">
                                       <thead>
                                       <th class="no-sort">
                                           <div class="mark-all-checkbox">
                                               <input type="checkbox" class="all-checkbox">
                                           </div>
                                       </th>
                                       <th>{{__('ID')}}</th>
                                       <th>{{__('Image')}}</th>
                                       <th>{{__('Title')}}</th>
                                       <th>{{__('Description')}}</th>
                                       <th>{{__('Action')}}</th>
                                       </thead>
                                       <tbody>
                                       @foreach($slider as $data)
                                           @php $img_url =''; @endphp
                                           <tr>
                                               <td>
                                                   <div class="bulk-checkbox-wrapper">
                                                       <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                   </div>
                                               </td>
                                               <td>{{$data->id}}</td>
                                               <td>
                                                   @php
                                                       $header_bg_img = get_attachment_image_by_id($data->image,null,true);
                                                       $img_url = '';
                                                   @endphp
                                                   @if (!empty($header_bg_img))
                                                       <div class="attachment-preview">
                                                           <div class="thumbnail">
                                                               <div class="centered">
                                                                   <img class="avatar user-thumb" src="{{$header_bg_img['img_url']}}" alt="">
                                                               </div>
                                                           </div>
                                                       </div>
                                                       @php  $img_url = $header_bg_img['img_url']; @endphp
                                                   @endif
                                               </td>
                                               <td>{{$data->title}}</td>
                                               <td>{{$data->description}}</td>
                                               <td>
                                                   <a tabindex="0" class="btn btn-xs btn-danger btn-sm mb-3 mr-1"
                                                      role="button"
                                                      data-toggle="popover"
                                                      data-trigger="focus"
                                                      data-html="true"
                                                      title=""
                                                      data-content="
                                               <h6>{{__('Are you sure to delete this header slider item?')}}</h6>
                                               <form method='post' action='{{route('admin.header.delete',$data->id)}}'>
                                               <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                               <br>
                                                <input type='submit' class='btn btn-danger btn-sm' value='{{__('Yes, Please')}}'>
                                                </form>
                                                ">
                                                       <i class="ti-trash"></i>
                                                   </a>
                                                   <a href="#"
                                                      data-toggle="modal"
                                                      data-target="#header_slider_item_edit_modal"
                                                      class="btn btn-xs btn-primary btn-sm mb-3 mr-1 header_slider_edit_btn"
                                                      data-id="{{$data->id}}"
                                                      data-title="{{$data->title}}"
                                                      data-subtitle="{{$data->subtitle}}"
                                                      data-imageid="{{$data->image}}"
                                                      data-image="{{$img_url}}"
                                                      data-lang="{{$data->lang}}"
                                                      data-description="{{$data->description}}"
                                                      data-btn_01_status="{{$data->btn_01_status}}"
                                                      data-btn_01_text="{{$data->btn_01_text}}"
                                                      data-btn_01_url="{{$data->btn_01_url}}"
                                                      data-video_btn_status="{{$data->video_btn_status}}"
                                                      data-video_btn_text="{{$data->video_btn_text}}"
                                                      data-video_btn_url="{{$data->video_btn_url}}"
                                                   >
                                                       <i class="ti-pencil"></i>
                                                   </a>
                                               </td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                            </div>
                                @php $b++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New Header Slider')}}</h4>
                        <form action="{{route('admin.header')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="language"><h6><strong>{{__('Languages')}}</strong></h6></label>
                                <select name="lang" id="language" class="form-control">
                                    @foreach($all_languages as $data)
                                    <option value="{{$data->slug}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <small>{{__("select language for make this text multilingual")}}</small>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">{{__('Subtitle')}}</label>
                                <input type="text" class="form-control"  id="subtitle"  name="subtitle" placeholder="{{__('Subtitle')}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control"  id="title"  name="title" placeholder="{{__('Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea class="form-control max-height-150"  id="description"  name="description" placeholder="{{__('Description')}}" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="btn_01_status">{{__('Button Show/Hide')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="btn_01_status" id="btn_01_status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="btn_01_text">{{__('Button Text')}}</label>
                                <input type="text" class="form-control"  id="btn_01_text"  name="btn_01_text" placeholder="{{__('Button Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="btn_01_url">{{__('Button URL')}}</label>
                                <input type="text" class="form-control"  id="btn_01_url"  name="btn_01_url" placeholder="{{__('Button URL')}}">
                            </div>
                            <div class="form-group">
                                <label for="video_btn_status">{{__('Video Button Show/Hide')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="video_btn_status" id="video_btn_status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="video_btn_text">{{__('Video Button Text')}}</label>
                                <input type="text" class="form-control"  id="video_btn_text"  name="video_btn_text" placeholder="{{__('Video Button Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="video_btn_url">{{__('Video Button URL')}}</label>
                                <input type="text" class="form-control"  id="video_btn_url"  name="video_btn_url" placeholder="{{__('Video URL')}}">
                            </div>

                            <div class="form-group">
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" name="image">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Slider Background" data-modaltitle="Upload Slider Background" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__('Upload Image')}}
                                    </button>
                                </div>
                                <small>{{__('recommended image size is 1920x900 pixel')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add  New Slider')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="header_slider_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Header Slider Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.header.update')}}" id="header_slider_edit_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="header_slider_id" value="">
                        <div class="form-group">
                            <label for="edit_language"><h6><strong>{{__('Languages')}}</strong></h6></label>
                            <select name="lang" id="edit_language" class="form-control">
                                @foreach($all_languages as $data)
                                    <option value="{{$data->slug}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            <small>{{__("select language for make this text multilingual")}}</small>
                        </div>
                        <div class="form-group">
                            <label for="edit_subtitle">{{__('Subtitle')}}</label>
                            <input type="text" class="form-control"  id="edit_subtitle"  name="subtitle" placeholder="{{__('Subtitle')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="edit_title"  name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">{{__('Description')}}</label>
                            <textarea class="form-control max-height-150"  id="edit_description"  name="description" placeholder="{{__('Description')}}" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_01_status">{{__('Button Show/Hide')}}</label>
                            <label class="switch">
                                <input type="checkbox" name="btn_01_status" id="edit_btn_01_status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_01_text">{{__('Button Text')}}</label>
                            <input type="text" class="form-control"  id="edit_btn_01_text"  name="btn_01_text" placeholder="{{__('Button Text')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_01_url">{{__('Button URL')}}</label>
                            <input type="text" class="form-control"  id="edit_btn_01_url"  name="btn_01_url" placeholder="{{__('Button URL')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_video_btn_status">{{__('Video Button Show/Hide')}}</label>
                            <label class="switch">
                                <input type="checkbox" name="video_btn_status" id="edit_video_btn_status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="edit_video_btn_text">{{__('Video Button Text')}}</label>
                            <input type="text" class="form-control"  id="edit_video_btn_text"  name="video_btn_text" placeholder="{{__('Video Button Text')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_video_btn_url">{{__('Video Button URL')}}</label>
                            <input type="text" class="form-control"  id="edit_video_btn_url"  name="video_btn_url" placeholder="{{__('Video URL')}}">
                        </div>
                        <div class="form-group">
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" id="edit_image" name="image" value="">
                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Slider Background" data-modaltitle="Upload Slider Background" data-imgid="{{auth()->user()->image}}" data-toggle="modal" data-target="#media_upload_modal">
                                    {{__('Upload Image')}}
                                </button>
                            </div>
                            <small>{{__('recommended image size is 1920x900 pixel')}}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function () {

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('{{__('Deleting...')}}');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.header.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $(document).on('click','.header_slider_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var action = el.data('action');
                var image = el.data('image');
                var imageid = el.data('imageid');
                var form = $('#header_slider_edit_modal_form');

                form.attr('action',action);
                form.find('#header_slider_id').val(id);
                form.find('#edit_subtitle').val(el.data('subtitle'));
                form.find('#edit_title').val(el.data('title'));
                form.find('#edit_description').val(el.data('description'));
                form.find('#edit_btn_01_text').val(el.data('btn_01_text'));
                form.find('#edit_btn_01_url').val(el.data('btn_01_url'));
                form.find('#edit_video_btn_text').val(el.data('video_btn_text'));
                form.find('#edit_video_btn_url').val(el.data('video_btn_url'));
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);//lang

                if(imageid != ''){
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }

                if(el.data('btn_01_status') == 'on'){
                    $('#edit_btn_01_status').prop('checked',true);
                }else{
                    $('#edit_btn_01_status').prop('checked',false);
                }
                if(el.data('video_btn_status') == 'on'){
                    console.log(el.data('video_btn_status'))
                    $('#edit_video_btn_status').prop('checked',true);
                }else{
                    $('#edit_video_btn_status').prop('checked',false);
                }
            });
        });
    </script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table-wrap > table').DataTable( { "order": [[ 1, "desc" ]],'columnDefs' : [{'targets' : 'no-sort','orderable' : false}]},
                );
        } );
    </script>
@endsection
