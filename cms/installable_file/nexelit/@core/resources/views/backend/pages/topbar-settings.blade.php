@extends('backend.admin-master')
@section('site-title')
    {{__('Topbar Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-6 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Topbar Button Settings')}}</h4>
                        <form action="{{route('admin.topbar.settings')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="navbar_button">{{__('Button Show/Hide')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="navbar_button"  @if(!empty(get_static_option('navbar_button'))) checked @endif id="navbar_button">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach( $all_languages as $key => $value)
                                    <a class="nav-item nav-link @if($key == 0) active @endif"  data-toggle="tab" href="#nav_{{$key}}" role="tab" aria-selected="true">{{$value->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach( $all_languages as $key => $value)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav_{{$key}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="navbar_{{$value->slug}}_button_text">{{__('Button Text')}}</label>
                                        <input type="text" name="navbar_{{$value->slug}}_button_text" class="form-control" value="{{get_static_option('navbar_'.$value->slug.'_button_text')}}" id="navbar_{{$value->slug}}_button_text">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="navbar_button_custom_url_status">{{__('Button Custom URL')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="navbar_button_custom_url_status"  @if(!empty(get_static_option('navbar_button_custom_url_status'))) checked @endif id="navbar_button_custom_url_status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button_custom_url">{{__('Quote Button URL')}}</label>
                                <input type="text" name="navbar_button_custom_url" class="form-control" value="{{get_static_option('navbar_button_custom_url')}}" id="navbar_button_custom_url">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Social Icons')}}</h4>
                        <div class="right-cotnent margin-bottom-40"><a class="btn btn-primary" data-target="#add_social_icon" data-toggle="modal" href="#">{{__('Add New Social Item')}}</a></div>
                        <table class="table table-default">
                            <thead>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Icon')}}</th>
                            <th>{{__('URL')}}</th>
                            <th>{{__('Action')}}</th>
                            </thead>
                            <tbody>
                            @foreach($all_social_icons as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td><i class="{{$data->icon}}"></i></td>
                                    <td>{{$data->url}}</td>
                                    <td>
                                        <x-delete-popover :url="route('admin.delete.social.item',$data->id)"/>
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#social_item_edit_modal"
                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 social_item_edit_btn"
                                           data-id="{{$data->id}}"
                                           data-url="{{$data->url}}"
                                           data-icon="{{$data->icon}}"
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
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Info Items')}}</h4>
                        <form action="{{route('admin.support.info.item')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                                $all_icon_fields =  get_static_option('home_page_07_topbar_section_info_item_icon');
                                $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : ['fas fa-envelope'];
                            @endphp
                            @foreach($all_icon_fields as $index => $icon_field)
                                <div class="iconbox-repeater-wrapper">
                                    <div class="all-field-wrap">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            @foreach($all_languages as $key => $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#tab_{{$lang->slug}}_{{$key + $index}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content margin-top-30" id="myTabContent">
                                            @foreach($all_languages as $key => $lang)
                                                @php
                                                    $all_title_fields = get_static_option('home_page_07_'.$lang->slug.'_topbar_section_info_item_title');
                                                    $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : ['Email'];
                                                    $all_details_fields = get_static_option('home_page_07_'.$lang->slug.'_topbar_section_info_item_details');
                                                    $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : ['example@example.com'];
                                                @endphp
                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$lang->slug}}_{{$key + $index}}" role="tabpanel" >
                                                    <div class="form-group">
                                                        <label for="home_page_07_{{$lang->slug}}_topbar_section_info_item_title">{{__('Title')}}</label>
                                                        <input type="text" name="home_page_07_{{$lang->slug}}_topbar_section_info_item_title[]" class="form-control" value="{{$all_title_fields[$index] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_07_{{$lang->slug}}_topbar_section_info_item_details">{{__('Details')}}</label>
                                                        <input type="text" name="home_page_07_{{$lang->slug}}_topbar_section_info_item_details[]" class="form-control" value="{{$all_details_fields[$index] ?? '' }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label for="home_page_07_topbar_section_info_item_icon" class="d-block">{{__('Icon')}}</label>
                                                <div class="btn-group ">
                                                    <button type="button" class="btn btn-primary iconpicker-component">
                                                        <i class="{{$icon_field}}"></i>
                                                    </button>
                                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                            data-selected="{{$icon_field}}" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu"></div>
                                                </div>
                                                <input type="hidden" class="form-control" value="{{$icon_field}}" name="home_page_07_topbar_section_info_item_icon[]">
                                            </div>

                                        </div>
                                        <div class="action-wrap">
                                            <span class="add"><i class="ti-plus"></i></span>
                                            <span class="remove"><i class="ti-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_social_icon" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add Social Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.new.social.item')}}"  method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="icon" class="d-block">{{__('Icon')}}</label>
                            <div class="btn-group ">
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
                            <input type="hidden" class="form-control"  id="icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="form-group">
                            <label for="social_item_link">{{__('URL')}}</label>
                            <input type="text" name="url" id="social_item_link"  class="form-control" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Add Social Item')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="social_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Social Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.update.social.item')}}"  method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="social_item_id" value="">

                        <div class="form-group">
                            <label for="icon" class="d-block">{{__('Icon')}}</label>
                            <div class="btn-group ">
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
                            <input type="hidden" class="form-control"  id="icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="form-group">
                            <label for="social_item_edit_url">{{__('Url')}}</label>
                            <input type="text" class="form-control"  id="social_item_edit_url" name="url" placeholder="{{__('Url')}}">
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
@endsection

@section('script')
    <script>
        (function($){
            "use strict";

            $(document).ready(function () {

                $(document).on('click','.social_item_edit_btn',function(){
                    var el = $(this);
                    var id = el.data('id');
                    var url = el.data('url');
                    var icon = el.data('icon');
                    var form = $('#social_item_edit_modal');
                    form.find('#social_item_id').val(id);
                    form.find('#social_item_edit_icon').val(icon);
                    form.find('#social_item_edit_url').val(url);
                    form.find('.icp-dd').attr('data-selected',el.data('icon'));
                    form.find('.iconpicker-component i').attr('class',el.data('icon'));
                });
                $('.icp-dd').iconpicker();
                $('.icp-dd').on('iconpickerSelected', function (e) {
                    var selectedIcon = e.iconpickerValue;
                    $(this).parent().parent().children('input').val(selectedIcon);
                });
            })
            $('.icp-dd').iconpicker();
            $('body').on('iconpickerSelected','.icp-dd', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
                $('body .dropdown-menu.iconpicker-container').removeClass('show');
            });

            $(document).on('click','.all-field-wrap .action-wrap .add',function (e){
                e.preventDefault();

                var el = $(this);
                var parent = el.parent().parent();
                var container = $('.all-field-wrap');
                var clonedData = parent.clone();
                var containerLength = container.length;
                clonedData.find('#myTab').attr('id','mytab_'+containerLength);
                clonedData.find('#myTabContent').attr('id','myTabContent_'+containerLength);
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

            });

            $(document).on('click','.all-field-wrap .action-wrap .remove',function (e){
                e.preventDefault();
                var el = $(this);
                var parent = el.parent().parent();
                var container = $('.all-field-wrap');

                if (container.length > 1){
                    el.show(300);
                    parent.hide(300);
                    parent.remove();
                }else{
                    el.hide(300);
                }
            });

        })(jQuery);
    </script>
@endsection
