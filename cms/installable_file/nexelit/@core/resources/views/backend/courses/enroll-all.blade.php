@extends('backend.admin-master')
@section('site-title')
    {{__('Courses Enroll')}}
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="top-wrapp d-flex justify-content-between">
                            <div class="left-part">
                                <h4 class="header-title">{{__('All Enrollment')}}</h4>
                                <div class="bulk-delete-wrapper">
                                    <div class="select-box-wrap">
                                        <select name="bulk_option" id="bulk_option">
                                            <option value="">{{{__('Bulk Action')}}}</option>
                                            <option value="delete">{{{__('Delete')}}}</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                    </div>
                                </div>
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
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Payment Gateway')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                <th>{{__('Enroll Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_enroll as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{optional(optional($data->course)->lang)->title ?? __('Untitled')}}</td>
                                        <td>{{str_replace('_',' ',$data->payment_gateway)}}</td>
                                        <td>
                                           <x-status-span :status="$data->payment_status"/>
                                        </td>
                                        <td>
                                            <x-status-span :status="$data->status"/>
                                        </td>
                                        <td>
                                            <x-delete-popover :url="route('admin.courses.enroll.delete',$data->id)"/>
                                            <x-view-icon :url="route('admin.courses.enroll.view', $data->id)"/>
                                            @if($data->payment_status == 'pending')
                                                <x-backend.reminder-icon :url="route('admin.course.enroll.reminder')" :id="$data->id"/>
                                            @endif
                                            @if($data->payment_gateway === 'manual_payment' && $data->payment_status == 'pending')
                                                <x-backend.payment-approve :url="route('admin.course.enroll.payment.approve',$data->id)" />
                                            @endif

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
@endsection
@section('script')
    @include('backend.partials.bulk-action',['action' => route('admin.course.enroll.bulk.action')])
    @include('backend.partials.datatable.script-enqueue')
@endsection
