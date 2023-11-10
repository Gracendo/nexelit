@extends('backend.admin-master')
@section('style')
    @include('backend.partials.datatable.style-enqueue')
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('All Appointment booking time')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All booking time')}}</h4>
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
                        <table class="table table-default" id="all_blog_table">
                            <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Time')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </thead>
                            <tbody>
                            @foreach($all_booking_time as $data)
                                <tr>
                                    <td>
                                        <div class="bulk-checkbox-wrapper">
                                            <input type="checkbox" class="bulk-checkbox"
                                                   name="bulk_delete[]" value="{{$data->id}}">
                                        </div>
                                    </td>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->time}}</td>
                                    <td>
                                        <x-status-span :status="$data->status"/>
                                    </td>
                                    <td>
                                        <x-delete-popover :url="route('admin.appointment.booking.time.delete',$data->id)"/>
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#_edit_modal"
                                           class="btn btn-primary btn-xs mb-3 mr-1 _edit_btn"
                                           data-id="{{$data->id}}"
                                           data-time="{{$data->time}}"
                                           data-status="{{$data->status}}"
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
                        <h4 class="header-title">{{__('add new')}}</h4>
                        <form action="{{route('admin.appointment.booking.time.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="time">{{__('Time')}}</label>
                                <input type="text" class="form-control"  name="time" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" >
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

    <div class="modal fade" id="_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update booking time')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.appointment.booking.time.update')}}"  method="post">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="time">{{__('Time')}}</label>
                            <input type="text" class="form-control"  name="time" >
                        </div>
                        <div class="form-group">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control">
                                <option value="draft">{{__("Draft")}}</option>
                                <option value="publish">{{__("Publish")}}</option>
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
    @include('backend.partials.datatable.script-enqueue')
    @include('backend.partials.bulk-action',['action' =>route('admin.appointment.booking.time.bulk.action') ])
    <script>
        (function ($){
            "use strict";

            $(document).on('click','._edit_btn',function (e){
                var allData = $(this).data();
                var modalContainer = $('#_edit_modal form');
                modalContainer.find('input[name="id"]').val(allData.id);
                modalContainer.find('input[name="time"]').val(allData.time);
                modalContainer.find('select[name="status"] option[value="'+allData.status+'"]').attr('selected',true);
            });

        })(jQuery);
    </script>
@endsection
