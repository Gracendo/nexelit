@extends('backend.admin-master')
@section('site-title')
    {{__('Courses Category')}}
@endsection
@section('style')
    @include('backend.partials.datatable.style-enqueue')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Courses Categories')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Icon')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_category as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{optional($data->lang)->title ?? __('Untitled')}}</td>
                                        <td>
                                           <x-status-span :status="$data->status"/>
                                        </td>
                                        <td>
                                            <i class="fa-3x {{$data->icon}}" ></i>
                                        </td>
                                        <td>
                                            <x-delete-popover :url="route('admin.courses.category.delete',$data->id)"/>
                                            <a href="#"
                                               data-toggle="modal"
                                               data-target="#category_edit_modal"
                                               class="btn btn-primary btn-xs mb-3 mr-1 category_edit_btn"
                                               data-id="{{$data->id}}"
                                               data-icon="{{$data->icon}}"
                                               data-status="{{$data->status}}"
                                               data-lang="{{$data->lang_all}}"
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
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Category')}}</h4>
                        <form action="{{route('admin.courses.category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif"  data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-40" >
                                @foreach($all_languages as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="name">{{__('Name')}}</label>
                                            <input type="text" class="form-control" name="title[{{$lang->slug}}]" placeholder="{{__('Name')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <x-backend.icon-field :title="__('Icon')" :name="'icon'"/>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish">{{__("Publish")}}</option>
                                    <option value="draft">{{__("Draft")}}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="category_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.courses.category.update')}}"  method="post">
                    <input type="hidden" name="id" >
                    <div class="modal-body">
                        @csrf
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($all_languages as $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->first) active @endif" data-language="{{$lang->slug}}" data-toggle="tab" href="#slider_tab_modal_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" >
                            @foreach($all_languages as $lang)
                                <div class="tab-pane fade @if($loop->first) show active @endif" data-language="{{$lang->slug}}"  id="slider_tab_modal_{{$lang->slug}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="name">{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="title[{{$lang->slug}}]" placeholder="{{__('Name')}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-backend.icon-field :title="__('Icon')" :name="'icon'"/>
                        <div class="form-group">
                            <label for="status">{{__('Status')}}</label>
                            <select name="status" class="form-control" >
                                <option value="publish">{{__("Publish")}}</option>
                                <option value="draft">{{__("Draft")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Change')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @include('backend.partials.bulk-action',['action' => route('admin.courses.category.bulk.action')])
    <script>
        (function ($){
            "use strict";
            $(document).ready(function () {
                $(document).on('click','.category_edit_btn',function(){
                    var el = $(this);
                    var id = el.data('id');
                    var status = el.data('status');
                    var modal = $('#category_edit_modal');
                    var langContent = el.data('lang');

                    modal.find('input[name="id"]').val(id);
                    modal.find('input[name="icon"]').val(el.data('icon'));
                    modal.find('.iconpicker-component i').addClass(el.data('icon'));
                    modal.find('select[name="status"] option[value="'+status+'"]').prop('selected',true);
                    langContent.forEach(function (item,index){
                        var tabByLang =  modal.find('.tab-pane[data-language="'+item.lang+'"]');
                        tabByLang.find('input[name="title['+item.lang+']"]').val(item.title);
                    });
                });
            });


        })(jQuery)
    </script>
    @include('backend.partials.datatable.script-enqueue')
    @include('backend.partials.icon-field.js')
@endsection
