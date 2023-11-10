@extends('backend.admin-master')
@section('style')
    @include('backend.partials.datatable.style-enqueue')
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('All Appointments Booking')}}
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
                        <h4 class="header-title">{{__('All Appointments Booking')}}</h4>
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
                                <th>{{__('Appointment Title')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Booking Times')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Payment Gateway')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_booking as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox"
                                                       name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{optional(optional($data->appointment)->lang)->title ?? __("Untitled")}}</td>
                                        <td>
                                            {{amount_with_currency_symbol($data->total)}}
                                        </td>
                                        <td>
                                            {{optional($data->booking_time)->time ?? __('Not Set')}}
                                        </td>
                                        <td>{{date('D,d F Y',strtotime($data->booking_date))}}</td>
                                        <td>{!! render_image_markup_by_attachment_id(get_static_option($data->payment_gateway.'_preview_logo'),'max-width-100') !!}</td>
                                        <td>
                                            <x-status-span :status="$data->payment_status"/>
                                        </td>
                                        <td>
                                            <x-status-span :status="$data->status"/>
                                        </td>
                                        <td>
                                            <x-delete-popover :url="route('admin.appointment.booking.delete',$data->id)"/>
                                            <x-view-icon :url="route('admin.appointment.booking.view',$data->id)"/>
                                            @if($data->payment_gateway === 'manual_payment' && $data->payment_status === 'pending')
                                                <x-backend.payment-approve :url="route('admin.appointment.booking.approve.payment',$data->id)"/>
                                            @endif
                                            @if( $data->payment_status === 'pending' && !empty($data->user_id))
                                                <x-backend.reminder-icon :url="route('admin.appointment.booking.reminder.mail')" :id="$data->id"/>
                                            @endif
                                            <a class="btn btn-xs btn-primary text-white mb-3 mr-1 update_booking_time_btn"
                                               data-toggle="modal"
                                               data-target="#edit_booking_modal"
                                               data-id="{{$data->id}}"
                                               data-booking_id="{{$data->booking_time_id}}"
                                               data-date="{{$data->booking_date}}">
                                                <i class="ti-pencil-alt"></i>
                                            </a>

                                            @if(!empty($data->manual_payment_attachment))
                                                <a class="btn btn-success btn-xs mb-3" href="{{url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''}}" target="_blank">
                                                    {{__('View Attachment')}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="edit_booking_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Booking Date & Time')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.appointment.booking.update')}}"  method="post" id="booking_modal_update_form">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="booking_date">{{__('Booking Date')}}</label>
                            <select name="booking_date" class="form-control">
                                <option value="{{date('d-m-Y')}}">{{date('D, d F, Y')}}</option>
                                @for($i=1; $i <7; $i++)
                                    <option value="{{date('d-m-Y',strtotime("+".$i." day"))}}">{{date('D, d F, Y',strtotime("+".$i." day"))}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="booking_time_id">{{__('Status')}}</label>
                            <select name="booking_time_id" class="form-control" >
                                @foreach($all_booking_time as $time)
                                <option value="{{$time->id}}">{{$time->time}}</option>
                                @endforeach
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
    @include('backend.partials.bulk-action',['action' =>route('admin.appointment.booking.bulk.action') ])
    <script>
        (function ($){
            "use strict";

            $(document).on('click','.update_booking_time_btn',function (e){
                e.preventDefault();
                var modalContainer = $('#booking_modal_update_form');
                var allData = $(this).data();
                modalContainer.find('input[name="id"]').val(allData.id);
                modalContainer.find('select[name="booking_date"] option[value="'+allData.date+'"]').prop('selected',true);
                modalContainer.find('select[name="booking_time_id"] option[value="'+allData.booking_id+'"]').prop('selected',true);

            });
        })(jQuery)
    </script>
@endsection
