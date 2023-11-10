@extends('backend.admin-master')
@section('style')
    @include('backend.partials.datatable.style-enqueue')
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('All Appointments')}}
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
                        <h4 class="header-title">{{__('All Appointments')}}</h4>
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
                            <table class="table table-default" >
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Booking Times')}}</th>
                                <th>{{__('Appointment Status')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_appointment as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox"
                                                       name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{optional($data->lang)->title ?? __('untitled')}}</td>
                                        <td>
                                            <div class="img-wrap">
                                                @php
                                                    $event_img = get_attachment_image_by_id($data->image,'thumbnail',true);
                                                @endphp
                                                @if (!empty($event_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb"
                                                                     src="{{$event_img['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{amount_with_currency_symbol($data->price)}}</td>
                                        <td>{{$data->category ? optional(optional($data->category)->lang)->title : __('Anonymous')}}</td>
                                        <td>
                                            <ul class="time_slot max-width-200">
                                            @forelse($data->booking_time_ids as  $time)
                                                <li>{{$time['time']}}</li>
                                            @empty
                                                <li>{{__('no time selected')}}</li>
                                            @endforelse
                                            </ul>
                                        </td>
                                        <td>
                                            <x-status-span :status="$data->appointment_status"/>
                                        </td>
                                        <td>
                                            <x-status-span :status="$data->status"/>
                                        </td>
                                        <td>
                                            <x-delete-popover :url="route('admin.appointment.delete',$data->id)"/>
                                            <x-edit-icon :url="route('admin.appointment.edit',$data->id)"/>
                                            <x-view-icon :url="route('frontend.appointment.single',[optional($data->lang)->slug ?? 'untitled',$data->id])"/>
                                            <x-backend.clone-icon :url="route('admin.appointment.clone')" :id="$data->id"/>


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
@endsection

@section('script')
    @include('backend.partials.datatable.script-enqueue')
    @include('backend.partials.bulk-action',['action' =>route('admin.appointment.bulk.action') ])
@endsection
