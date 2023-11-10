@extends('backend.admin-master')
@section('site-title')
    {{__('Team Member Item')}}
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
            <!-- basic form start -->
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
                        <h4 class="header-title">{{__('Team Member Items')}}</h4>
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
                            @foreach($all_team_member as $key => $team)
                                <li class="nav-$all_price_plan">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_team_member as $key => $team)
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
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Designation')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($team as $data)
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
                                                        $brand_img = get_attachment_image_by_id($data->image,null,true);
                                                    @endphp
                                                    @if (!empty($brand_img))
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="{{$brand_img['img_url']}}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php  $img_url = $brand_img['img_url']; @endphp
                                                    @endif
                                                </td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->designation}}</td>
                                                <td>
                                                    <x-delete-popover :url="route('admin.team.member.delete',$data->id)"/>
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#team_member_item_edit_modal"
                                                       class="btn btn-primary btn-xs mb-3 mr-1 team_member_edit_btn"
                                                       data-id="{{$data->id}}"
                                                       data-action="{{route('admin.team.member.update')}}"
                                                       data-name="{{$data->name}}"
                                                       data-imageid="{{$data->image}}"
                                                       data-image="{{$img_url}}"
                                                       data-designation="{{$data->designation}}"
                                                       data-lang="{{$data->lang}}"
                                                       data-iconOne="{{$data->icon_one}}"
                                                       data-iconTwo="{{$data->icon_two}}"
                                                       data-iconThree="{{$data->icon_three}}"
                                                       data-iconOneUrl="{{$data->icon_one_url}}"
                                                       data-iconTwoUrl="{{$data->icon_two_url}}"
                                                       data-iconThreeUrl="{{$data->icon_three_url}}"
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
                        <h4 class="header-title">{{__('New Team Member')}}</h4>
                        <form action="{{route('admin.team.member')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="languages">{{__('Languages')}}</label>
                                <select name="lang" class="form-control" id="languages">
                                    @foreach($all_languages as $lang)
                                        <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name"  name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="designation">{{__('Designation')}}</label>
                                <input type="text" class="form-control"  id="designation"  name="designation" placeholder="{{__('Designation')}}">
                            </div>
                            <div class="form-group">
                                <label for="icon_one" class="d-block">{{__('Social Profile One')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fab fa-instagram"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fab fa-instagram" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon_one" value="fab fa-instagram" name="icon_one">
                            </div>
                            <div class="form-group">
                                <label for="icon_one_url">{{__('Social Profile One URL')}}</label>
                                <input type="text" class="form-control"  id="icon_one_url"  name="icon_one_url" placeholder="{{__('Social Profile One URL')}}">
                            </div>
                            <div class="form-group">
                                <label for="icon_two" class="d-block">{{__('Social Profile Two')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fab fa-twitter" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon_two" value="fab fa-twitter" name="icon_two">
                            </div>
                            <div class="form-group">
                                <label for="icon_two_url">{{__('Social Profile Two URL')}}</label>
                                <input type="text" class="form-control"  id="icon_two_url"  name="icon_two_url" placeholder="{{__('Social Profile Two URL')}}">
                            </div>
                            <div class="form-group">
                                <label for="icon_three" class="d-block">{{__('Social Profile Three')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fab fa-facebook-f" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon_three" value="fab fa-facebook-f" name="icon_three">
                            </div>
                            <div class="form-group">
                                <label for="icon_three_url">{{__('Social Profile Three URL')}}</label>
                                <input type="text" class="form-control"  id="icon_three_url"  name="icon_three_url" placeholder="{{__('Social Profile Three URL')}}">
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" name="image">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Team Image')}}" data-modaltitle="{{__('Upload Team Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__('Upload Image')}}
                                    </button>
                                </div>
                                <small>{{__('Recommended image size 270x280')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add  New Team Member')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="team_member_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Team Member Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="#" id="team_member_edit_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="team_member_id" value="">
                        <div class="form-group">
                            <label for="edit_languages">{{__('Languages')}}</label>
                            <select name="lang" class="form-control" id="edit_languages">
                                @foreach($all_languages as $lang)
                                    <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_name">{{__('Name')}}</label>
                            <input type="text" class="form-control"  id="edit_name"  name="name" placeholder="{{__('Name')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_designation">{{__('Designation')}}</label>
                            <input type="text" class="form-control"  id="edit_designation"  name="designation" placeholder="{{__('Designation')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_one" class="d-block">{{__('Social Profile One')}}</label>
                            <div class="btn-group edit_icon_one">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon_one" value="fas fa-exclamation-triangle" name="icon_one">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_one_url">{{__('Social Profile One URL')}}</label>
                            <input type="text" class="form-control"  id="edit_icon_one_url"  name="icon_one_url" placeholder="{{__('Social Profile One URL')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_two" class="d-block">{{__('Social Profile Two')}}</label>
                            <div class="btn-group edit_icon_two">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon_two" value="fas fa-exclamation-triangle" name="icon_two">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_two_url">{{__('Social Profile Two URL')}}</label>
                            <input type="text" class="form-control"  id="edit_icon_two_url"  name="icon_two_url" placeholder="{{__('Social Profile Two URL')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_three" class="d-block">{{__('Social Profile Three')}}</label>
                            <div class="btn-group edit_icon_three">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon_three" value="fas fa-exclamation-triangle" name="icon_three">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_three_url">{{__('Social Profile Three URL')}}</label>
                            <input type="text" class="form-control"  id="edit_icon_three_url"  name="icon_three_url" placeholder="{{__('Social Profile Three URL')}}">
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" id="edit_image" name="image" value="">
                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Team Image')}}" data-modaltitle="{{__('Upload Team Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                    {{__('Upload Image')}}
                                </button>
                            </div>
                            <small>{{__('Recommended image size 270x280')}}</small>
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
                        'url' : "{{route('admin.team.member.bulk.action')}}",
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

            $(document).on('click','.team_member_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var designation = el.data('designation');
                var action = el.data('action');
                var image = el.data('image');
                var imageid = el.data('imageid');
                var form = $('#team_member_edit_modal_form');

                form.attr('action',action);
                form.find('#team_member_id').val(id);
                form.find('#edit_name').val(name);
                form.find('#edit_designation').val(designation);
                form.find('#edit_description').val(el.data('description'));
                form.find('#edit_icon_one').val(el.data('iconone'));
                form.find('#edit_icon_two').val(el.data('icontwo'));
                form.find('#edit_icon_three').val(el.data('iconthree'));
                form.find('#edit_icon_one_url').val(el.data('icononeurl'));
                form.find('#edit_icon_two_url').val(el.data('icontwourl'));
                form.find('#edit_icon_three_url').val(el.data('iconthreeurl'));
                form.find('#preview_image').attr('src',image);
                form.find('#edit_languages option[value="'+el.data('lang')+'"]').attr('selected',true);

                form.find('.edit_icon_three .icp-dd').attr('data-selected',el.data('iconthree'));
                form.find('.edit_icon_three .iconpicker-component i').attr('class',el.data('iconthree'));
                form.find('.edit_icon_two .icp-dd').attr('data-selected',el.data('icontwo'));
                form.find('.edit_icon_two .iconpicker-component i').attr('class',el.data('icontwo'));
                form.find('.edit_icon_one .icp-dd').attr('data-selected',el.data('iconone'));
                form.find('.edit_icon_one .iconpicker-component i').attr('class',el.data('iconone'));

                if(imageid != ''){
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }

            });

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
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

            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
        } );
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
