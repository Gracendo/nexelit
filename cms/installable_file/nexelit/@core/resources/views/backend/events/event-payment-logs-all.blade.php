@extends('backend.admin-master')
@section('style')
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
@section('site-title')
    {{__('All Event Payment Logs')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
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
                                    <h4 class="header-title">{{__('All Event Payment Logs')}}</h4>
                                    <div class="bulk-delete-wrapper">
                                        <div class="select-box-wrap">
                                            <select name="bulk_option" id="bulk_option">
                                                <option value="">{{{__('Bulk Action')}}}</option>
                                                <option value="delete">{{{__('Delete')}}}</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                        </div>
                                    </div>
                                    <div class="data-tables datatable-primary table-responsive">
                                        <table id="all_user_table" >
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th>{{__('ID')}}</th>
                                                <th>{{__('Payer Name')}}</th>
                                                <th>{{__('Payer Email')}}</th>
                                                <th>{{__('Event Name')}}</th>
                                                <th>{{__('Event Cost')}}</th>
                                                <th>{{__('Quantity')}}</th>
                                                <th>{{__('Package Gateway')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($payment_logs as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{$data->event_name}}</td>
                                                    <td>{{amount_with_currency_symbol($data->event_cost)}}</td>
                                                    <td>{{!empty($data->attendance_logs->quantity) ? $data->attendance_logs->quantity : ''}}</td>
                                                    <td><strong>{{ucwords(str_replace('_',' ',$data->package_gateway))}}</strong></td>
                                                    <td>
                                                        @if($data->status === 'pending')
                                                            <span class="alert alert-warning text-capitalize">{{__($data->status)}}</span>
                                                        @else
                                                            <span class="alert alert-success text-capitalize">{{__($data->status)}}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{date_format($data->created_at,'d M Y')}}</td>
                                                    <td>
                                                        <x-delete-popover :url="route('admin.event.payment.delete',$data->id)"/>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#view_quote_details_modal"
                                                           data-email="{{$data->email}}"
                                                           data-name="{{$data->name}}"
                                                           data-event_name="{{$data->event_name}}"
                                                           data-event_cost="{{site_currency_symbol()}}{{$data->event_cost}}"
                                                           data-payment_gateway="{{ucwords(str_replace('_',' ',$data->package_gateway))}}"
                                                           data-attendance_id="{{$data->attendance_id}}"
                                                           data-transaction_id="{{$data->transaction_id}}"
                                                           data-status="{{$data->status}}"
                                                           data-date="{{date_format($data->created_at,'d M Y')}}"
                                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 view_quote_details_btn"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        @if($data->package_gateway == 'manual_payment' && $data->status == 'pending')
                                                            <x-backend.payment-approve :url="route('admin.event.payment.approve',$data->id)" />
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
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_quote_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="view-quote-details-info">
                    <h4 class="title">{{__('View Payment Logs Details Information')}}</h4>
                    <div class="view-quote-top-wrap">
                        <div class="status-wrap">
                            {{__('Status:')}} <span class="quote-status-span"></span>
                        </div>
                        <div class="data-wrap">
                           {{__(' Date:')}} <span class="quote-date-span"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="quote-all-custom-fields table-striped table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function($) {

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
                        'url' : "{{route('admin.event.payment.bulk.action')}}",
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

            $(document).on('click','.view_quote_details_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var parent = $('#view_quote_details_modal');
                var statusClass = allData.status == 'pending' ? 'alert alert-warning' : 'alert alert-success';

                parent.find('.quote-status-span').text(allData.status).addClass(statusClass);
                parent.find('.quote-date-span').text(allData.date);
                parent.find('.quote-all-custom-fields').html('');
                delete allData.date;
                delete allData.status;
                delete allData.target;
                delete allData.toggle;
                $.each(allData,function (index,value) {
                    var curSymbol = index == 'package_price' ? "{{site_currency_symbol()}}" :  "";
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">'+index.replace('_',' ')+'</td> <td class="fvalue">'+curSymbol+value+'</td></tr>');
                });
            });

            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );

        } );
    </script>
@endsection

